@extends('layouts.master-client')

@section('content')

@livewire('frontend.service')

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>DIAGRAM JUMLAH PERMOHONAN </h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    <h6>Data diagram dalam persentase</h6>
                        {!! $donut_data->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ $donut_data ? $donut_data->cdn() : null }}"></script>

@if (!empty($donut_data))
    {{ $donut_data->script() }}
@endif

@endpush

@endsection
