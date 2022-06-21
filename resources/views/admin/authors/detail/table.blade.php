<x-livewire-tables::table.cell>
    @if($row->type == 2)
        <span class="text-primary"><i class="fa fa-star"></i></span>
    @endif
    <span class="font-weight-bold {{ ($row->published_at > date(now()) ? 'text-danger' : '') }}">{!! $row->title !!}</span>

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{!! $row->getCategory->name !!}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <div class="row d-flex justify-content-center">
        <div class="badge  {{ ($row->published_at > date(now()) ? 'badge-light-danger' : 'badge-light-primary') }}">{{ $row->published_at->format('d, M-Y | H:i') }}</div>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="avatar-group text-center">
        @foreach ($row->getAuthor($row->id) as $item)
            <a href="#">
                <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{!! $item['type'].': '.$item['name'] !!}">
                    <img src="{{ $item['avatar'] }}" alt="Avatar" height="32" width="32" />
                </div>
            </a>
        @endforeach
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

<x-livewire-tables::table.cell class="text-center">
    <span class="font-weight-bolder text-primary">
        {{ number_format($row->counter) }}
    </span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('posts.edit', $row->id) }}">
                    <i class="mr-1 fas fa-edit"></i>
                    <span class="align-middle">Edit</span>
                </a>
                <a type="button" class="dropdown-item" wire:click="showModalDetail({{ $row->id }})">
                    <i class="mr-1 fas fa-desktop"></i>
                    <span class="align-middle">Detail</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
