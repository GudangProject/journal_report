<x-livewire-tables::table.cell>
    <span class="font-weight-bold">{{ $row->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div class="badge badge-primary">
        <span>{!! $row->knowledge->name !!}</span>
    </div>
</x-livewire-tables::table.cell >

<x-livewire-tables::table.cell>
    <span>{{ $row->volume }} No. {{ $row->number }} {{ $row->month }} {{ $row->year }}, Semester: {{ $row->semester }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="{{ $row->link_issue }}" class="badge badge-primary">link issue</a><br>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->indexasi }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->afiliate }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->total }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span>{{ $row->createdBy->name }}</span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <span class="badge badge-success"><a href="https://wa.me/{{ $row->createdBy->phone }}">{{ $row->createdBy->phone }}</a></span>
</x-livewire-tables::table.cell>

