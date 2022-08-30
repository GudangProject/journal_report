<x-livewire-tables::table.cell>
    <div class="avatar-group text-center">
        <a href="{{ $row->image }}" data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $row->caption }}">
            <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0">
                <img src="{{ $row->image }}" alt="Avatar" height="32" width="32" />
            </div>
        </a>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {!! $row->caption !!}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="text-center">
    <div class="btn-group btn-group-sm" role="group" aria-label="Action">
        <a href="{{ route('photos-content.edit', $row->id) }}" class="btn btn-primary" title="Edit"><i class="fas fa-pen"></i></a>
        <button wire:click.prevent="deleteModal({{ $row->id }})" class="btn btn-primary" title="Delete"><i class="fas fa-trash"></i></button>
    </div>
</x-livewire-tables::table.cell>
