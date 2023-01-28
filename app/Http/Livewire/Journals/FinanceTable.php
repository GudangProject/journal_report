<?php

namespace App\Http\Livewire\Journals;

use App\Exports\PaymentExport;
use App\Models\Journals\Journal;
use App\Models\Journals\Knowledge;
use App\Models\Journals\Mybank;
use App\Models\Journals\Naskah;
use App\Models\Journals\Payment;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class FinanceTable extends DataTableComponent
{

    public string $defaultSortColumn = 'balance';
    public string $defaultSortDirection = 'desc';

    public $selected_id, $status;
    public $no_rekening, $bank, $owner;

    public function showModalDetail($id)
    {

    }

    public function editModal($id)
    {
        $this->selected_id =$id;
        $data = Mybank::findOrFail($id);
        $this->no_rekening = $data->no_rekening;
        $this->bank = $data->bank;
        $this->owner = $data->owner;

        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function update()
    {
        try {
            Mybank::where('id', $this->selected_id)->update([
                'no_rekening' => $this->no_rekening,
                'bank' => $this->bank,
                'owner' => $this->owner,
            ]);

            session()->flash('message', 'Nomor rekening berhasil diupdate');
            return redirect()->route('reports.finance');

        } catch (Exception $error) {
            session()->flash('error', 'Data tidak boleh kosong');
            return redirect()->route('reports.finance');
        }


    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Mybank::findOrFail($this->selected_id)->delete();

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function deleteSelectedModal()
    {
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected(){
        Mybank::whereIn('id', $this->selectedKeys)->delete();
        $this->dispatchBrowserEvent('closeModalDeleteSelected');
    }

    public function columns(): array
    {
        return [
            Column::make('No. Rekening'),
            Column::make('Bank'),
            Column::make('Owner', 'name')->sortable(),
            Column::make('Saldo', 'balance')->sortable(),
            Column::make('Aksi'),
        ];
    }

    // public array $bulkActions = [
    //     'exportSelected' => 'Export',
    // ];

    public function exportSelected()
    {
        // return Excel::download(New PaymentExport($this->selectedKeys), 'data_pembayaran.xlsx');
    }

    public function query(): Builder
    {
        $user = auth()->user();

        $data = Mybank::query();
        // if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] == 'author'){
        // }
        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('owner', 'like', '%'.$term.'%')->orWhere('no_rekening', 'like', '%'.$term.'%'));
        // $data = $data->when($this->getFilter('journal'), fn ($query, $journal) => $query->whereHas('journal', fn ($q) => $q->where('journal_id', $journal)));
        // $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.journals.reports.finance.table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.reports.finance.modal';
    }
}
