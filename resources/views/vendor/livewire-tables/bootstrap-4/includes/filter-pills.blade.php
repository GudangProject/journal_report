<div>
    @if ($showFilters && count($this->getFiltersWithoutSearch()))
        <div>
            <small>@lang('Filter By'):</small>

            @foreach($filters as $key => $value)
                @if ($key !== 'search' && strlen($value))
                    <span
                        wire:key="filter-pill-{{ $key }}"
                        class="badge badge-pill badge-secondary d-inline-flex align-items-center"
                    >
                        {{ $filterNames[$key] ?? collect($this->columns())->pluck('text', 'column')->get($key, ucwords(strtr($key, ['_' => ' ', '-' => ' ']))) }}:
                        @if(isset($customFilters[$key]) && method_exists($customFilters[$key], 'options'))
                            {{ $customFilters[$key]->options()[$value] ?? $value }}
                        @else
                            {{ ucwords(strtr($value, ['_' => ' ', '-' => ' '])) }}
                        @endif

                        <a
                            href="#"
                            wire:click.prevent="removeFilter('{{ $key }}')"
                            class="text-white ml-2"
                        >
                            <span class="sr-only">@lang('Remove filter option')</span>
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                @endif
            @endforeach

            <a
                href="#"
                wire:click.prevent="resetFilters"
                class="btn btn-sm btn-primary"
            >
                @lang('Clear')
            </a>
        </div>
    @endif
</div>
