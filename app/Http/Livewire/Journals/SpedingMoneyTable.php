<?php

namespace App\Http\Livewire\Journals;

use App\Exports\PaymentExport;
use App\Exports\SpedingMoneyExport;
use App\Models\Journals\Journal;
use App\Models\Journals\SpedingMoney;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class SpedingMoneyTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $mybank_id, $selected_id, $status;

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        SpedingMoney::findOrFail($this->selected_id)->delete();

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function deleteSelectedModal()
    {
        $this->dispatchBrowserEvent('openModalDeleteSelected');
    }

    public function deleteSelected(){
        SpedingMoney::whereIn('id', $this->selectedKeys)->delete();
        $this->dispatchBrowserEvent('closeModalDeleteSelected');
    }

    public function columns(): array
    {
        return [
            Column::make('Nominal Pengeluaran', 'amount')->sortable(),
            Column::make('Keterangan'),
            Column::make('Oleh'),
            Column::make('Aksi'),
        ];
    }

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    public function exportSelected()
    {
        return Excel::download(New SpedingMoneyExport($this->selectedKeys), 'data_pengeluaran.xlsx');
    }

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
            'bulan' => Filter::make('Bulan')
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

        $data = SpedingMoney::query();
        $data = $data->where('mybank_id', $this->mybank_id);
        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('description', 'like', '%'.$term.'%')->orWhere('amount', 'like', '%'.$term.'%'));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.journals.reports.finance.speding-money-table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.payment.modal';
    }
}
