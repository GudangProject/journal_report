<?php

namespace App\Http\Livewire;

use App\Models\Office;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class OfficeTable extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;
    public $name, $title, $content, $image;

    public function showModalDetail($id)
    {
        $this->selected_id = $id;
        $data = Office::findOrFail($id);
        $this->title = $data->title;
        $this->content = $data->content;
        $this->image = $data->image;
        $this->dispatchBrowserEvent('openModalDetail');
    }

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus(){
        $data = Office::findOrFail($this->selected_id);
        ($data->status == 1 ? $data->update(['status' => 2]) : $data->update(['status' => 1]));
        Cache::flush('offices');
        $this->dispatchBrowserEvent('closeModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        Office::findOrFail($this->selected_id)->update(['status' => 3]);
        Cache::flush('offices');

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Title'),
            Column::make('Category')->addClass('text-center'),
            Column::make('Publish','published_at')->sortable(),
            Column::make('Author'),
            Column::make('Status'),
            Column::make('View', 'counter')->sortable(),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] != 'admin editor'){
            return Office::query()
                ->where('status', '!=', 3)
                ->where('title', auth()->user()->kota)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));
        }else{
            return Office::query()
                ->where('status', '!=', 3)
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('title', 'like', '%'.$term.'%'));
        }

    }

    public function rowView(): string
    {
        return 'admin.offices.table';
    }

    public function modalsView(): string
    {
        return 'admin.offices.modal';
    }
}
