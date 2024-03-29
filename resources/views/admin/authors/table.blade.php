
<x-livewire-tables::table.cell>
    <span class="avatar">
        <img class="rounded" src="{{ isset($row->image) ? '/storage/pictures/users/mid/'.$row->image : asset('assets/images/dummy-image.jpeg') }}" alt="{{ $row->name }}" height="40">
    </span>
</x-livewire-tables::table.cell>
<x-livewire-tables::table.cell>
    @if($row->type == 2)
        <span class="text-primary"><i class="fa fa-star"></i></span>
    @endif
    <span class="font-weight-bold">{!! ucwords($row->name) !!}</span>

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="avatar-group text-center">
        <a href="#">
            @php
                $user_type = explode(',', $row->user_type);
            @endphp
            @foreach ($user_type as $type)
                <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{!! config('app.user_type')[$type] !!}">
                    <img src="https://ui-avatars.com/api/?name={{urlencode($type) }}&color=ffffff&background=005599" alt="Avatar" height="32" width="32" />
                </div>
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
                <a class="dropdown-item" href="{{ route('authors.edit', $row->id) }}">
                    <i class="mr-1 fas fa-edit"></i>
                    <span class="align-middle">Edit</span>
                </a>
                <a type="button" class="dropdown-item" href="{{ route('authors.show', $row->id) }}">
                    <i class="mr-1 fas fa-desktop"></i>
                    <span class="align-middle">Detail</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
