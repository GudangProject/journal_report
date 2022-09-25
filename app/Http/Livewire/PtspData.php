<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service\Service;

class PtspData extends DataTableComponent
{
    public string $defaultSortColumn = 'layanan_created_at';
    public string $defaultSortDirection = 'desc';

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
        Service::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Layanan'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return Service::query()
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('nama_layanan', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'admin.ptsp.data.table';
    }

    public function modalsView(): string
    {
        return 'admin.ptsp.data.modal';
    }
}
