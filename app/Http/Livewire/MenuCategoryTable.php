<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\MenuCategory;
use Illuminate\Support\Str;

class MenuCategoryTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id, $data, $category;
    public $name, $description, $status;

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = MenuCategory::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function editModal($id)
    {
        $this->selected_id = $id;
        $data = MenuCategory::findOrFail($id);
        $this->name = $data->name;
        $this->description = $data->description;
        $this->status = $data->status;
        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function update()
    {
        $save = MenuCategory::findOrFail($this->selected_id);
        $save->name = $this->name;
        $save->description = $this->description;
        $save->status = $this->status;
        $save->updated_by = auth()->user()->id;
        $save->save();
        $this->dispatchBrowserEvent('closeModalEdit');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        $data = MenuCategory::findOrFail($this->selected_id)->update(['status' => 3]);
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama'),
            Column::make('Link'),
            Column::make('Add'),
            Column::make('Status'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return MenuCategory::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        $this->category = MenuCategory::where('status', 1)->get();
        return 'admin.menus.categories.table';
    }

    public function modalsView(): string
    {
        return 'admin.menus.categories.modal';
    }
}
