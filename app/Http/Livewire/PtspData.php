<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service\ServiceDetail as Service;
use App\Models\Service\ServiceRequest;
use App\Models\Service\Service as Categories;

class PtspData extends DataTableComponent
{
    public string $defaultSortColumn = 'detail_layanan_created_at';
    public string $defaultSortDirection = 'desc';

    public $selected_id;
    public $categories;
    public $name, $persyaratan, $category;

    public function mount(){
        $this->categories = Categories::all();
    }

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
        ServiceRequest::where('detail_layanan_id', $this->selected_id)->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
    }

    public function saveData(){
        Service::insert([
            'nama_detail_layanan' => $this->name,
            'persyaratan_detail_layanan' => $this->persyaratan,
            'layanan_id' => $this->category,
        ]);

        session()->flash('message', 'Data PTSP Berhasil ditambahkan.');
        $this->dispatchBrowserEvent('closeModalCreate');

    }

    public function columns(): array
    {
        return [
            Column::make('Name'),
            Column::make('Persyaratan'),
            Column::make('Kategori'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return Service::query()
                ->when($this->getFilter('search'), fn ($query, $term) => $query->where('nama_detail_layanan', 'like', '%'.$term.'%'));
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
