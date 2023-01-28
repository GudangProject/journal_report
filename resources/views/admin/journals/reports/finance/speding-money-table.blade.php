<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{{ $row->amount }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <p>{{ $row->description }}</p>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <span>{{ $row->usedBy->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#" wire:click='deleteModal({{ $row->id }})'>
                    <i class="mr-1 fas fa-trash text-danger"></i>
                    <span class="align-middle">HAPUS</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
