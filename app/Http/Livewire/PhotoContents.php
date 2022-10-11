<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PhotoContent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class PhotoContents extends DataTableComponent
{

    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'asc';

    public $selected_id;

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        PhotoContent::findOrFail($this->selected_id)->delete();
        Cache::flush("photos");

        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Photo'),
            Column::make('Caption'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        $user = auth()->user();

        if($user->getRoleNames()[0] != 'super admin' && $user->getRoleNames()[0] != 'admin editor'){
            return PhotoContent::query()
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('caption', 'like', '%'.$term.'%'));
        }else{
            return PhotoContent::query()
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('caption', 'like', '%'.$term.'%'));
        }

    }

    public function rowView(): string
    {
        return 'admin.photos.linkage.table-linkage';
    }

    public function modalsView(): string
    {
        return 'admin.images.modal';
    }
}
