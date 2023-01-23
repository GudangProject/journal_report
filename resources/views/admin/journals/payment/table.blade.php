<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{{ $row->journal->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        {{-- <span>{!! $row->knowledge->name !!}</span> --}}
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <span>{{ $row->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->manuscript_name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="{{ $row->manuscript_link }}">{{ $row->manuscript_link }}</a>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->created_at }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->price }}</span>
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
