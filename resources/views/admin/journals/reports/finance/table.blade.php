<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{{ $row->no_rekening }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{{ $row->bank }}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <span>{{ $row->owner }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <strong>Rp {{ number_format($row->balance) }}</strong>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <strong>Rp {{ number_format($row->spedingMoney) }}</strong>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('payment.invoice', ['id' => $row->id]) }}">
                    <i class="mr-1 fas fa-credit-card"></i>
                    <span class="align-middle">DETAIL</span>
                </a>
                <a class="dropdown-item" href="#" wire:click='editModal({{ $row->id }})'>
                    <i class="mr-1 fas fa-pen"></i>
                    <span class="align-middle">EDIT</span>
                </a>
                <a class="dropdown-item" href="#" wire:click='deleteModal({{ $row->id }})'>
                    <i class="mr-1 fas fa-trash text-danger"></i>
                    <span class="align-middle">HAPUS</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
