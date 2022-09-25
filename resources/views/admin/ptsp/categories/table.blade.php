<x-livewire-tables::table.cell>
    <span>{!! $row->nama !!}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{!! $row->email !!}</span>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <div class="btn-group">
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {!! $row->status_permohonan !!}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton100">
            <a class="dropdown-item" wire:click="updateStatus('baru', {{ $row->id_permohonan_layanan }})">BARU</a>
            <a class="dropdown-item" wire:click="updateStatus('proses', {{ $row->id_permohonan_layanan }})">PROSES</a>
            <a class="dropdown-item" wire:click="updateStatus('selesai', {{ $row->id_permohonan_layanan }})">SELESAI</a>
            <a class="dropdown-item" wire:click="updateStatus('batal', {{ $row->id_permohonan_layanan }})">BATAL</a>
        </div>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/storage/files/service/{{ $row->file_persyaratan }}">
                    <i class="mr-1 fas fa-download"></i>
                    <span class="align-middle">Detail File Persyaratan</span>
                </a>
                <div class="dropdown-divider"></div>
                <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id_permohonan_layanan }})">
                    <i class="mr-1 fas fa-trash"></i>
                    <span class="align-middle">Delete</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
