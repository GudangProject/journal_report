<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{!! $row->getAuthor->name !!}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="text-center">
    <div class="badge badge-primary">
        <span>{{ $row->totalPost }}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell class="text-center">
    <div class="badge badge-primary">
        <span>{{ $row->totalPoint }}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell class="text-center">
    <div class="badge badge-primary">
        <span>{{ $row->totalPoint }}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                @if(app('currentTenant')->id == 1)
                <a class="dropdown-item" href="#">
                    <i class="mr-1 fas fa-plus"></i>
                    <span class="align-middle">Add Page</span>
                </a>
                @endif
                <a class="dropdown-item" href="{{ route('post.edit', $row->id) }}">
                    <i class="mr-1 fas fa-edit"></i>
                    <span class="align-middle">Edit</span>
                </a>
                @if(app('currentTenant')->id != 1)
                    @if($row->visibility != 3)
                    <a class="dropdown-item" wire:click="reposted({{ $row->id }})">
                        <i class="mr-1 fas fa-arrow-alt-circle-up"></i>
                        <span class="align-middle">Repost</span>
                    </a>
                    @endif
                @endif
                <a type="button" class="dropdown-item" wire:click="showModal({{ $row->id }})">
                    <i class="mr-1 fas fa-desktop"></i>
                    <span class="align-middle">Detail</span>
                </a>
                <a class="dropdown-item" target="_blank" href="https://nu.or.id/post/read/{{$row->id.'/'.$row->slug }}">
                    <i class="mr-1 fas fa-eye"></i>
                    <span class="align-middle">Web</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
