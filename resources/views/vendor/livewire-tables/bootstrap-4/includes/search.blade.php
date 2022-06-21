@if ($showSearch)
    <div class="mb-3 mb-md-0 input-group">
        <input
            wire:model{{ $this->searchFilterOptions }}="filters.search"
            placeholder="{{ __('Search') }}"
            type="text"
            class="form-control"
        >

        @if (isset($filters['search']) && strlen($filters['search']))
            <div class="input-group-append">
                <button wire:click="$set('filters.search', null)" class="btn btn-primary" type="button">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    </div>
@endif
