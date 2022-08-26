<?php

namespace App\Http\Livewire;

use App\Models\Photos;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PhotosTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;
    public $title, $image, $description;

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function showModalDetail($id)
    {
        $this->selected_id  = $id;
        $data               = Photos::findOrFail($id);
        $this->title        = $data->title;
        $this->image        = $data->image;
        $this->description  = $data->description;
        $this->dispatchBrowserEvent('openModalDetail');
    }

    public function updateStatus(){
        $data = Photos::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Photos::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Title'),
            Column::make('Publish','created_at')->sortable(),
            Column::make('Photos'),
            Column::make('Author'),
            Column::make('Status'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return Photos::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'admin.photos.table';
    }

    public function modalsView(): string
    {
        return 'admin.images.modal';
    }
}
