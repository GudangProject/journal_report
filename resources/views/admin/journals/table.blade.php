<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{{ $row->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{!! $row->knowledge->name !!}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <span>{{ $row->volume }} No. {{ $row->number }} {{ $row->month }} {{ $row->year }}, Semester: {{ $row->semester }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="{{ $row->link_issue }}">{{ $row->link_issue }}</a>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->indexasi }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->afiliate }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->total }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->createdBy->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->createdBy->phone }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->status == 1)
        <div class="avatar bg-light-success rounded">
            <a type="button" @role('super admin|admin editor') wire:click="statusModal({{ $row->id }})" @endrole>
                <div class="avatar-content">
                    <i class="avatar-icon fa fa-check font-medium-2"></i>
                </div>
            </a>
        </div>
    @else
        <div class="avatar bg-light-danger rounded">
            <a type="button" @role('super admin|admin editor') wire:click="statusModal({{ $row->id }})" @endrole>
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
                    <a class="dropdown-item" href="{{ route('journals.edit', $row->id) }}">
                        <i class="mr-1 fas fa-edit"></i>
                        <span class="align-middle">Edit</span>
                    </a>
                    @role('super admin|admin')
                    <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
                        <i class="mr-1 fas fa-trash"></i>
                        <span class="align-middle">Delete</span>
                    </a>
                    @endrole
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
