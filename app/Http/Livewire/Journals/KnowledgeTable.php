<?php

namespace App\Http\Livewire\Journals;

use App\Models\Journals\Knowledge;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class KnowledgeTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;
    public $name, $status;

    public function showModalDetail($id)
    {

    }

    public function editModal($id)
    {
        $this->selected_id = $id;
        $data = Knowledge::find($id);
        $this->name = $data->name;
        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Knowledge::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0 ]) : $data->update(['status' => 1]));

        Cache::flush('knowledge');

        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Knowledge::findOrFail($this->selected_id)->delete();

        Cache::flush('knowledge');

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Rumpun Ilmu')->sortable(),
            Column::make('Aksi'),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        $data = Knowledge::query();
        // if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] == 'pic'){
        //     $data = $data->where('created_by', $user->id);
        // }
        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.journals.knowledge.table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.knowledge.modal';
    }
}
