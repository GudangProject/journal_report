<?php

namespace App\Http\Livewire\Journals;

use App\Models\Journals\Loa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LoaTable extends DataTableComponent
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
        // $this->selected_id = $id;
        // $data = Loa::find($id);
        // $this->name = $data->name;
        // $this->dispatchBrowserEvent('openModalEdit');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Loa::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0 ]) : $data->update(['status' => 1]));

        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Loa::findOrFail($this->selected_id)->delete();

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama')->sortable(),
            Column::make('Jurnal'),
            Column::make('Aksi'),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        $data = Loa::query();
        if($user->getRoleNames()[0] == 'author'){
            $data = $data->where('user_id', $user->id);
        }else if($user->getRoleNames()[0] == 'pic'){
            $data = $data->where('created_by', $user->id);
        }

        $data = $data->when($this->getFilter('search'), fn ($query, $term) => $query->where('username', 'like', '%'.$term.'%'));

        return $data;



    }

    public function rowView(): string
    {
        return 'admin.journals.loa.table';
    }

    public function modalsView(): string
    {
        return 'admin.journals.loa.modal';
    }
}
