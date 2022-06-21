<x-livewire-tables::table.cell>
    @if($row->type == 2)
        <span class="text-primary"><i class="fa fa-star"></i></span>
    @endif
    <span class="font-weight-bold {{ ($row->published_at > date(now()) ? 'text-danger' : '') }}">{!! $row->title !!}</span>

</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="text-center">
    <div class="badge badge-primary">
        <span>{!! $row->getCategory->name !!}</span>
    </div>
</x-livewire-tables::table.cell >
