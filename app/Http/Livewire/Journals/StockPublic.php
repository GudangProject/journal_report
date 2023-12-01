<?php

namespace App\Http\Livewire\Journals;

use App\Exports\JournalExport;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Facades\Cache;
use App\Models\Journals\Journal as JournalModel;
use App\Models\Journals\Knowledge;
use Maatwebsite\Excel\Facades\Excel;

class StockPublic extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    public bool $useHeaderAsFooter = true;

    public $selected_id;

    public function showModalDetail($id)
    {

    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = JournalModel::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0 ]) : $data->update(['status' => 1]));

        Cache::flush('journals');

        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        JournalModel::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Judul', 'name')->sortable(),
            Column::make('Rumpun Ilmu'),
            Column::make('Volume'),
            Column::make('Link Issue'),
            Column::make('Indexasi'),
            Column::make('Afiliasi'),
            Column::make('Stok'),
            Column::make('Pengelola'),
        ];
    }

    // public array $bulkActions = [
    //     'exportSelected' => 'Export',
    // ];

    public function exportSelected()
    {
        return Excel::download(New JournalExport($this->selectedKeys()), 'data_jurnal.xlsx');
    }

    public function filters(): array
    {
        $dataKnowledge = Knowledge::where('status', 1)->get();
        $journal       = JournalModel::all();
        $all           = array("0" => '--Semua--');

        $knowledge = array();
        foreach ($dataKnowledge as $k => $v) {
            $knowledge[$k]['id'] = $v->id;
            $knowledge[$k]['name'] = $v->name;
        }

        $data = collect($knowledge)->mapWithKeys(function ($name) {
            return [$name['id'] => $name['name']];
        })->toArray();


        $dataJournal = array();
        foreach ($journal as $k => $v) {
            $dataJournal[$k]['volume'] = $v->volume;
            $dataJournal[$k]['month'] = $v->month;
            $dataJournal[$k]['number'] = $v->number;
            $dataJournal[$k]['year'] = $v->year;
            $dataJournal[$k]['indexasi'] = $v->indexasi;
            $dataJournal[$k]['semester'] = $v->semester;
        }

        // volume
        $dataVolume = collect($dataJournal)->mapWithKeys(function ($volumeName) {
            return [$volumeName['volume'] => $volumeName['volume']];
        })->toArray();

        // month
        $dataMonth = collect($dataJournal)->mapWithKeys(function ($month) {
            return [$month['month'] => $month['month']];
        })->toArray();

        // number
        $dataNumber = collect($dataJournal)->mapWithKeys(function ($number) {
            return [$number['number'] => $number['number']];
        })->toArray();

        // year
        $dataYear = collect($dataJournal)->mapWithKeys(function ($year) {
            return [$year['year'] => $year['year']];
        })->toArray();

        // indexasi
        $dataIndexasi = collect($dataJournal)->mapWithKeys(function ($indexasi) {
            return [$indexasi['indexasi'] => $indexasi['indexasi']];
        })->toArray();

        // semester
        $dataSemester = collect($dataJournal)->mapWithKeys(function ($semester) {
            return [$semester['semester'] => $semester['semester']];
        })->toArray();

        return [
            'knowledge' => Filter::make('Rumpun Ilmu')
                ->select($data),
            'volume' => Filter::make('Volume')
                ->select($dataVolume),
            'number' => Filter::make('Number')
                ->select($dataNumber),
            'month' => Filter::make('Bulan')
                ->select($dataMonth),
            'year' => Filter::make('Tahun')
                ->select($dataYear),
            'indexasi' => Filter::make('INDEXASI')
                ->select($dataIndexasi),
            'semester' => Filter::make('Semester')
                ->select($dataSemester),
            'status' => Filter::make('Status')
                ->select([
                    1 => 'Aktif',
                    2 => 'Tidak Aktif',
                ]),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        $data = JournalModel::query();
        // if($user->getRoleNames()[0] == 'super admin' && $user->getRoleNames()[0] == 'pic'){
        //     $data = $data->where('created_by', $user->id);
        // }
        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%' . $term . '%'));
        $data = $data->when($this->getFilter('knowledge'), fn ($query, $knowledge) => $query->whereHas('knowledge', fn ($q) => $q->where('knowledge_id', $knowledge)));
        $data = $data->when($this->getFilter('volume'), fn ($query, $volume) => $query->where('volume', $volume));
        $data = $data->when($this->getFilter('number'), fn ($query, $number) => $query->where('number', $number));
        $data = $data->when($this->getFilter('month'), fn ($query, $month) => $query->where('month', $month));
        $data = $data->when($this->getFilter('year'), fn ($query, $year) => $query->where('year', $year));
        $data = $data->when($this->getFilter('indexasi'), fn ($query, $indexasi) => $query->where('indexasi', $indexasi));
        $data = $data->when($this->getFilter('semester'), fn ($query, $semester) => $query->where('semester', $semester));
        $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));

        return $data;
    }

    public function rowView(): string
    {
        return 'admin.journals.reports.stock-table';
    }

    // public function modalsView(): string
    // {
    //     return 'admin.journals.modal';
    // }
}
