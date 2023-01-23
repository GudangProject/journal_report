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

<x-livewire-tables::table.cell>
    <div class="content-header-right">
        <div class="dropdown">
            <button class="btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chevron-circle-down font-medium-3"></i></button>
            <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ asset('storage/pictures/payment/big/'.$row->image) }}">
                        <i class="mr-1 fas fa-image"></i>
                        <span class="align-middle">Bukti Bayar</span>
                    </a>
                    <a class="dropdown-item" href="{{ route('payment.edit', $row->id) }}">
                        <i class="mr-1 fas fa-edit"></i>
                        <span class="align-middle">Edit</span>
                    </a>
                    @role('super admin|admin')
                    <a type="button" class="dropdown-item" wire:click="deleteModal({{ $row->id }})">
                        <i class="mr-1 fas fa-trash"></i>
                        <span class="align-middle">Delete</span>
                    </a>
                    @endrole
            </div>
        </div>
    </div>
</x-livewire-tables::table.cell>
