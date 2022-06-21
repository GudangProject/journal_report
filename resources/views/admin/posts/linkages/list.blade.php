<x-livewire-tables::table.cell>
    <span class="font-weight-bolder">
        {!! $row->getPost->title !!}
    </span>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="text-center">
    <div class="badge badge-primary">{{ $row->getPost->getCategory->name }}</div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="text-center">
    <div class="badge badge-light-primary">{{ $row->getPost->published_at->diffForHumans() }}</div>
</x-livewire-tables::table.cell>
