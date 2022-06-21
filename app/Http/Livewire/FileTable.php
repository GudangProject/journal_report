<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\File;

class FileTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = File::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        File::findOrFail($this->selected_id)->update(['status' => 3]);
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Title'),
            Column::make('Category'),
            Column::make('Publish','created_at')->sortable(),
            Column::make('Author'),
            Column::make('Status'),
            Column::make('View', 'counter')->sortable(),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return File::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'admin.files.table';
    }

    public function modalsView(): string
    {
        return 'admin.files.modal';
    }
}
