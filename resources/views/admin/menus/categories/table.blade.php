<x-livewire-tables::table.cell>
    <span>{{ $row->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span class="badge badge-light-primary">{{ $row->slug }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="#">
        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{!! 'Ditambahkan: '.$row->getAdd->name !!}">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($row->getAdd->name) }}&color=3f6da1&background=e2e8ef" alt="Avatar" height="32" width="32" />
        </div>
    </a>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->status == 1)
        <div class="avatar bg-light-success rounded">
            <a type="button" wire:click="statusModal({{ $row->id }})">
                <div class="avatar-content">
                    <i class="avatar-icon fa fa-check font-medium-2"></i>
                </div>
            </a>
        </div>
    @else
        <div class="avatar bg-light-danger rounded">
            <a type="button" wire:click="statusModal({{ $row->id }})">
                <div class="avatar-content">
                    <i class="avatar-icon fa fa-times font-medium-2"></i>
                </div>
            </a>
        </div>
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a type="button" class="dropdown-item" wire:click="editModal({{ $row->id }})">
                    <i class="mr-1 fas fa-desktop"></i>
                    <span class="align-middle">Edit</span>
                </a>
                <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
                    <i class="mr-1 fas fa-trash"></i>
                    <span class="align-middle">Delete</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>


