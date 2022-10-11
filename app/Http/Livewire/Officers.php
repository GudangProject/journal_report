<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Officer;
use Illuminate\Support\Facades\DB;

class Officers extends DataTableComponent
{

    public string $defaultSortColumn = 'order';
    public string $defaultSortDirection = 'asc';

    public $selected_id;
    public $name, $content, $image;

    public function showModalDetail($id)
    {
        $this->selected_id = $id;
        $data = Officer::findOrFail($id);
        $this->name = $data->name;
        $this->content = $data->description;
        $this->image = $data->image;
        $this->dispatchBrowserEvent('openModalDetail');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Officer::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Officer::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function moveUp($id)
    {
        $row = Officer::findOrFail($id);
        $data = $row->order - 1;

        if($row->parent_id){
            DB::table('officers')->where('order',$data)->increment('order');
            DB::table('officers')->where('id', $id)->decrement('order');
        }else{
            DB::table('officers')->where('order',$data)->increment('order');
            DB::table('officers')->where('id', $id)->decrement('order');
        }
    }

    public function moveDown($id)
    {
        $row = Officer::findOrFail($id);
        $data = $row->order + 1;

        if($row->parent_id){
            DB::table('officers')->where('order',$data)->decrement('order');
            DB::table('officers')->where('id', $id)->increment('order');
        }else{
            DB::table('officers')->where('order',$data)->decrement('order');
            DB::table('officers')->where('id', $id)->increment('order');
        }

    }

    public function columns(): array
    {
        return [
            Column::make('Nama'),
            Column::make('Jabatan'),
            Column::make('Publish','published_at')->sortable(),
            Column::make('Create By'),
            Column::make('Status'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] != 'admin editor'){
            return Officer::query()
                ->where('status', '!=', 3)
                ->where('name', auth()->user()->kota)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
        }else{
            return Officer::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
        }

    }

    public function rowView(): string
    {
        return 'admin.officers.table';
    }

    public function modalsView(): string
    {
        return 'admin.officers.modal';
    }
}
