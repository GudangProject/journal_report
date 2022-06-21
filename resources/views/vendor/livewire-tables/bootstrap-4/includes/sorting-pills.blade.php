<div>
    @if ($showSorting && count($sorts))
        <div class="">
            <small>@lang('Sort By'):</small>

            @foreach($sorts as $col => $dir)
                <span
                    wire:key="sorting-pill-{{ $col }}"
                    class="badge badge-pill badge-secondary d-inline-flex align-items-center"
                >
                    <span>{{ $sortNames[$col] ?? collect($this->columns())->pluck('text', 'column')->get($col, ucwords(strtr($col, ['_' => ' ', '-' => ' ']))) }}: {{ $dir === 'asc' ? ($sortDirectionNames[$col]['asc'] ?? 'A-Z') : ($sortDirectionNames[$col]['desc'] ?? 'Z-A') }}</span>

                    <a
                        href="#"
                        wire:click.prevent="removeSort('{{ $col }}')"
                        class="text-white ml-2"
                    >
                        <span class="sr-only">@lang('Remove sort option')</span>
                        <i class="fas fa-times"></i>
                    </a>
                </span>
            @endforeach

            <a
                href="#"
                wire:click.prevent="resetSorts"
                class="btn btn-sm btn-primary"
            >
                @lang('Clear')
            </a>
        </div>
    @endif
</div>
