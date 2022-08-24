<x-livewire-tables::table.cell>
    {!! $row->name !!}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{!! $row->position !!}</span>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <div class="badge badge-light-primary">{{ $row->created_at->format('d, M-Y | H:i') }}</div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="avatar-group text-center">
        <a href="#">
            <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{!! 'Ditambahkan: '.$row->getAdd->name !!}">
                <img src="{{ $row->getAvatar($row->getAdd->name) }}" alt="Avatar" height="32" width="32" />
            </div>
        </a>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="text-center">
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

<x-livewire-tables::table.cell class="text-center">
    <div class="btn-group btn-group-sm" role="group" aria-label="Action">
        @if($row->order != 1)
        <button wire:click.prevent="moveUp({{ $row->id }})" class="btn btn-primary" title="Up"><i class="fas fa-chevron-up"></i></button>
        @endif
        @if($row->order != $row->count())
        <button wire:click.prevent="moveDown({{ $row->id }})" class="btn btn-primary" title="Down"><i class="fas fa-chevron-down"></i></button>
        @endif
        <a href="{{ route('officers.edit', $row->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-pen"></i></a>
        <button wire:click.prevent="deleteModal({{ $row->id }})" class="btn btn-primary" title="Delete"><i class="fas fa-trash"></i></button>
    </div>
</x-livewire-tables::table.cell>
