<x-livewire-tables::table.cell>
    @if($row->type == 2)
        <span class="text-primary"><i class="fa fa-star"></i></span>
    @endif
    <span class="font-weight-bold {{ ($row->created_at > date(now()) ? 'text-danger' : '') }}">{!! $row->nama_jurnal !!}</span>

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{!! $row->volume !!}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{!! $row->jumlah_naskah !!}</span>
    </div>
</x-livewire-tables::table.cell >

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
                    <a class="dropdown-item" href="{{ route('posts.edit', $row->id) }}">
                        <i class="mr-1 fas fa-edit"></i>
                        <span class="align-middle">Edit</span>
                    </a>
                    <a type="button" class="dropdown-item" wire:click="showModalDetail({{ $row->id }})">
                        <i class="mr-1 fas fa-desktop"></i>
                        <span class="align-middle">Detail</span>
                    </a>
                    @if($row->published_at < date(now()))
                    <a class="dropdown-item" target="_blank" href="{{env('APP_URL').'/'.$row->getCategory->slug.'/'.$row->slug.'-'.$row->code }}">
                        <i class="mr-1 fas fa-eye"></i>
                        <span class="align-middle">Web</span>
                    </a>
                    @endif
                    @role('super admin|admin editor')
                    <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
                        <i class="mr-1 fas fa-trash"></i>
                        <span class="align-middle">Delete</span>
                    </a>
                    @endrole
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
