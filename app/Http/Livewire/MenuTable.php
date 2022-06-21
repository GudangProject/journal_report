<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MenuTable extends DataTableComponent
{
    public $selected_id;

    public function moveUp($id)
    {
        $row = Menu::findOrFail($id);
        $data = $row->order - 1;

        if($row->parent_id){
            DB::table('menus')->where('parent_id', $row->parent_id)->where('order',$data)->increment('order');
            DB::table('menus')->where('parent_id', $row->parent_id)->where('id', $id)->decrement('order');
        }else{
            DB::table('menus')->where('category_id', 1)->where('order',$data)->increment('order');
            DB::table('menus')->where('category_id', 1)->where('id', $id)->decrement('order');
        }
    }

    public function moveDown($id)
    {
        $row = Menu::findOrFail($id);
        $data = $row->order + 1;

        if($row->parent_id){
            DB::table('menus')->where('parent_id', $row->parent_id)->where('order',$data)->decrement('order');
            DB::table('menus')->where('parent_id', $row->parent_id)->where('id', $id)->increment('order');
        }else{
            DB::table('menus')->where('category_id', 1)->where('order',$data)->decrement('order');
            DB::table('menus')->where('category_id', 1)->where('id', $id)->increment('order');
        }

    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Menu::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = Menu::findOrFail($this->selected_id)->update(['status' => 3]);
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama'),
            Column::make('Link'),
            Column::make('Kategori'),
            Column::make('Add'),
            Column::make('Status'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return Menu::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'))->orderBy('order', 'asc');
    }

    public function rowView(): string
    {
        return 'admin.menus.table';
    }

    public function modalsView(): string
    {
        return 'admin.menus.modal';
    }
}
