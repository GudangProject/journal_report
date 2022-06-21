@if ($showFilterDropdown && ($filtersView || count($customFilters)))
    <div
        x-cloak
        x-data="{ open: false }"
        x-on:keydown.escape.stop="open = false"
        x-on:mousedown.away="open = false"
        class="btn-group d-block d-md-inline"
    >

        <button
            x-on:click="open = !open"
            type="button"
            class="btn btn-primary btn-round dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        >
            @lang('Filters')

            @if (count($this->getFiltersWithoutSearch()))
                <span class="ml-2 text-dark">
                   {{ count($this->getFiltersWithoutSearch()) }}
                </span>
            @endif
        </button>
        <ul
            class="dropdown-menu"
            x-bind:class="{'show' : open}"
            role="menu"
        >
            <li>
                @if ($filtersView)
                    @include($filtersView)
                @elseif (count($customFilters))
                    @foreach ($customFilters as $key => $filter)
                        <div wire:key="filter-{{ $key }}" class="p-1">
                            <label for="filter-{{ $key }}" class="">
                                <strong>{{ $filter->name() }}</strong>
                            </label>

                            @if ($filter->isSelect())
                                @include('livewire-tables::bootstrap-4.includes.filter-type-select')
                            @elseif($filter->isDate())
                                @include('livewire-tables::bootstrap-4.includes.filter-type-date')
                            @endif
                        </div>
                    @endforeach
                @endif

                @if (count($this->getFiltersWithoutSearch()))
                    <div class="dropdown-divider"></div>

                    <button
                        wire:click.prevent="resetFilters"
                        x-on:click="open = false"
                        class="dropdown-item btn btn-primary text-center ml-1"
                    >
                        @lang('Clear')
                    </button>
                @endif
            </li>
        </ul>
    </div>
@endif
