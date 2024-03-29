<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{{ $row->journal->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{{ $row->knowledge }}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <span>{{ $row->payer_name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @foreach ($row->naskah() as $item)
        <a href="{{ $item->link }}" class="badge badge-light-primary" style="margin: 3px;">
            {{ $item->name }}
        </a>
    @endforeach
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->date }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span class="font-weight-bold text-primary">{{ number_format($row->price) }}</span>
</x-livewire-tables::table.cell>

{{-- <x-livewire-tables::table.cell>
    <div class="btn-group">
        @role('author')
        <button class="btn btn-sm btn-{{ $row->status == 1 ? 'success' : 'secondary' }}">
            {{ $row->status == 1 ? 'LUNAS' : 'PENDING' }}
        </button>
        @endrole
        @role('super admin|finance')
        <button class="btn btn-sm btn-{{ $row->status == 1 ? 'success' : 'secondary' }} dropdown-toggle waves-effect waves-float waves-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $row->status == 1 ? 'LUNAS' : 'PENDING' }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
            <a class="dropdown-item" href="javascript:void(0);" wire:click='statusModal({{ $row->id }}, 1)'>LUNAS</a>
            <a class="dropdown-item" href="javascript:void(0);" wire:click='statusModal({{ $row->id }}, 0)'>PENDING</a>
        </div>
        @endrole
    </div>
</x-livewire-tables::table.cell> --}}

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('payment.invoice', ['id' => $row->id]) }}">
                    <i class="mr-1 fas fa-file"></i>
                    <span class="align-middle">Invoice</span>
                </a>
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
