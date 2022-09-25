<x-livewire-tables::table.cell>
    <span>{!! $row->nama_detail_layanan !!}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{!! $row->persyaratan_detail_layanan !!}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{!! $row->getService->nama_layanan !!}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id_detail_layanan }})">
                    <i class="mr-1 fas fa-trash"></i>
                    <span class="align-middle">Delete</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
