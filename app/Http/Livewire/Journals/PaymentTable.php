<?php

namespace App\Http\Livewire\Journals;

use App\Models\Journals\Journal;
use App\Models\Journals\Knowledge;
use App\Models\Journals\Naskah;
use App\Models\Journals\Payment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class PaymentTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id, $status;

    public function showModalDetail($id)
    {

    }

    public function statusModal($id, $status)
    {
        $this->selected_id = $id;
        $this->status = $status;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Payment::findOrFail($this->selected_id);
        $data->update(['status' => $this->status]);

        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $payment     = Payment::findOrFail($this->selected_id);
        $naskahCount = Naskah::where('payment_id', $this->selected_id)->get()->count();
        $journal     = Journal::findOrFail($payment->journal_id);
        $updateStock = $journal->update(['total' => $journal->total + $naskahCount]);

        if($updateStock){
            $payment->delete();
        }

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function deleteSelectedModal()
    {
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected(){
        Payment::whereIn('id', $this->selectedKeys)->delete();
        $this->dispatchBrowserEvent('closeModalDeleteSelected');
    }

    public function columns(): array
    {
        return [
            Column::make('Judul', 'name')->sortable(),
            Column::make('Rumpun Ilmu'),
            Column::make('Nama'),
            Column::make('Judul Naskah'),
            Column::make('Tanggal Pembayaran'),
            Column::make('Nominal'),
            Column::make('Status'),
            Column::make('Aksi'),
        ];
    }

    // public array $bulkActions = [
    //     'deleteSelectedModal' => 'Delete',
    // ];

    public function filters(): array
    {
        $dataJournal = Journal::where('status', 1)->get();

        $journal = array();
        foreach($dataJournal as $k=>$v){
            $journal[$k]['id'] = $v->id;
            $journal[$k]['name'] = $v->name;
        }

        $data = collect($journal)->mapWithKeys(function ($name) {
            return [$name['id'] => $name['name']];
        })->toArray();
        // dd($data);
        return [
            'journal' => Filter::make('Nama Jurnal')
                ->select($data),
            'status' => Filter::make('Status')
                ->select([
                    '0' => '--Semua--',
                    1 => 'Aktif',
                    2 => 'Tidak Aktif',
                ]),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        $data = Payment::query();
        if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] == 'author'){
            $data = $data->where('created_by', $user->id);
        }
        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
        $data = $data->when($this->getFilter('journal'), fn ($query, $journal) => $query->whereHas('journal', fn ($q) => $q->where('journal_id', $journal)));
        $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.journals.payment.table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.payment.modal';
    }
}
