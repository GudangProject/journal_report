<?php

namespace App\Http\Livewire;

use App\Models\OfficeCategory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class OfficeCategoryTable extends DataTableComponent
{

    public $selected_id, $data, $category;
    public $name, $description, $parent_id;

    public function editModal($id)
    {
        $this->selected_id = $id;
        $data = OfficeCategory::findOrFail($id);
        $this->name = $data->name;
        $this->description = $data->description;
        $this->parent_id = $data->parent_id;
        $this->dispatchBrowserEvent('openModalEdit');
    }

    public function update()
    {
        $save = OfficeCategory::findOrFail($this->selected_id);
        $save->name = $this->name;
        $save->slug = Str::slug($this->name);
        $save->description = $this->description;
        $save->parent_id = $this->parent_id;
        $save->updated_by = auth()->user()->id;
        $save->save();
        $this->dispatchBrowserEvent('closeModalEdit');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = OfficeCategory::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 0]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function columns(): array
    {
        return [
            Column::make('Title'),
            Column::make('Slug'),
            Column::make('Parent'),
            Column::make('Dibuat'),
            Column::make('Status'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return OfficeCategory::query()
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%')
                ->orWhere('description', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        $this->category = OfficeCategory::where('status', 1)->get();
        return 'admin.offices.categories.table';
    }

    public function modalsView(): string
    {
        return 'admin.offices.categories.modal';
    }
}
