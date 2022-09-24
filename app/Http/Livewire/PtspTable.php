<?php

namespace App\Http\Livewire;

use App\Models\Service\ServiceRequest;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PtspTable extends DataTableComponent
{
    public string $defaultSortColumn = 'permohonan_created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;

    public function statusModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalStatus');
    }

    public function updateStatus($value, $id){
        $data = ServiceRequest::findOrFail($id);
        $data->status_permohonan = $value;
        $data->save();
    }

    public function deleteModal($id)
    {
        $this->selected_id = $id;
        $this->dispatchBrowserEvent('openModalDelete');
    }

    public function deleteStatus(){
        ServiceRequest::findOrFail($this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function columns(): array
    {
        return [
            Column::make('Name'),
            Column::make('Email'),
            Column::make('Status Permohonan'),
            // Column::make('Status Antrian'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return ServiceRequest::query()
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('nama', 'like', '%'.$term.'%'));
    }

    public function rowView(): string
    {
        return 'admin.ptsp.table';
    }

    public function modalsView(): string
    {
        return 'admin.ptsp.modal';
    }
}
