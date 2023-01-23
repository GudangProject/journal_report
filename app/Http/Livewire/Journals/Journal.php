<?php

namespace App\Http\Livewire\Journals;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Facades\Cache;
use App\Models\Journals\Journal as JournalModel;
use App\Models\Journals\Knowledge;

class Journal extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

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
            Column::make('Jumlah'),
            Column::make('Upload By'),
            Column::make('No HP'),
            Column::make('Status'),
            Column::make('Aksi'),
        ];
    }

    public function filters(): array
    {
        $dataKnowledge = Knowledge::where('status', 1)->get();

        $knowledge = array();
        foreach($dataKnowledge as $k=>$v){
            $knowledge[$k]['id'] = $v->id;
            $knowledge[$k]['name'] = $v->name;
        }
        $data = collect($knowledge)->mapWithKeys(function ($name) {
            return [$name['id'] => $name['name']];
        })->toArray();
        // dd($data);
        return [
            'knowledge' => Filter::make('Rumpun Ilmu')
                ->select(
                    array_merge([
                        '0' => '--Semua--',
                      ], $data)
                ),
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

        $data = JournalModel::query();
        if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] != 'admin editor'){
            $data = $data->where('created_by', $user->id);
        }
        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
        $data = $data->when($this->getFilter('knowledge'), fn ($query, $knowledge) => $query->whereHas('knowledge', fn ($q) => $q->where('knowledge_id', $knowledge)));
        $data = $data->when($this->getFilter('status'), fn ($query, $status) => $query->where('status', $status));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.journals.table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.modal';
    }
}