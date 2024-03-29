<x-livewire-tables::table.cell>
    <span>{!! $row->title !!}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-light-primary">{{ $row->created_at->format('d, M-Y | H:i') }}</div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="avatar-group">
        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="">
            <a data-fancybox="gallery-a" data-fancybox data-type="image" href="{{ $row->image }}" data-caption="{{ $row->caption }}">
                <img src={{ $row->image }} alt="Avatar" height="35" width="35" />
            </a>
        </div>
        @foreach (\App\Models\PhotoContent::where('photo_id', $row->id)->orderBy('created_at')->limit(4)->get() as $key => $item)
            <div style="display:{{ $key > 2 ? 'none' : 'block' }}" data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Klik untuk melihat detail">
                <a data-fancybox="gallery-a" data-fancybox data-type="image" href="{{ $item->image }}" data-caption="{{ $item->caption }}">
                    <img src={{ $item->image }} alt="Avatar" height="35" width="35" />
                </a>
            </div>
        @endforeach
        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="Tambah Foto Terkait">
            <a href="{{ route('create-photos-linkage', $row->id) }}">
                <img src="{{ asset('app-assets') }}/images/icons/plus.png" alt="Avatar" height="35" width="35" />
            </a>
        </div>
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
        @if($row->editBy->id)
        <a href="#">
            <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{!! 'Terakhir Edit: '.$row->editBy->name !!}">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($row->editBy->name) }}&color=c3352b&background=f2bab6" alt="Avatar" height="32" width="32" />
            </div>
        </a>
        @endif
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

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('photos.edit', $row->id) }}">
                    <i class="mr-1 fas fa-edit"></i>
                    <span class="align-middle">Edit</span>
                </a>
                <a type="button" class="dropdown-item" href="{{ route('photos.show', $row->id) }}">
                    <i class="mr-1 fas fa-desktop"></i>
                    <span class="align-middle">Detail</span>
                </a>
                {{-- @if($row->published_at < date(now()))
                <a class="dropdown-item" target="_blank" href="{{env('APP_URL').'/'.$row->getCategory->slug.'/'.$row->slug.'-'.$row->code }}">
                    <i class="mr-1 fas fa-eye"></i>
                    <span class="align-middle">Web</span>
                </a>
                @endif --}}
                <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
                    <i class="mr-1 fas fa-trash"></i>
                    <span class="align-middle">Delete</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
