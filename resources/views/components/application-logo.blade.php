@php
    $logo = \App\Models\Websetting::orderBy('created_at')->first();
@endphp
<span class="brand-logo text-xl">

@if (isset($logo->logo))
    <img src="{{ asset('storage') }}/assets/{{ $logo->logo }}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0 bg-secondary" height="50" width="180" alt="Logo" />
@endif
</span>
