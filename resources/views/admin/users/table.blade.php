<x-livewire-tables::table.cell>
    @if($row->type == 2)
        <span class="text-primary"><i class="fa fa-star"></i></span>
    @endif
    <span class="font-weight-bold">{!! ucwords($row->name) !!}</span>

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->email }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="avatar-group text-center">
        <a href="#" class="badge badge-light-dark">
            {{ $row->company ?? '-' }}
        </a>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="avatar-group text-center">
        <a href="#" class="badge badge-light-primary">
            @foreach ($row->getRoleNames() as $role)
                {{ ucwords($role) }}
            @endforeach
        </a>
    </div>
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
                <a class="dropdown-item" wire:click="confirmResetPassword({{ $row->id }})">
                    <i class="mr-1 fas fa-key"></i>
                    <span class="align-middle">Reset Password</span>
                </a>
                <a class="dropdown-item" href="{{ route('users.edit', $row->id) }}">
                    <i class="mr-1 fas fa-edit"></i>
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
