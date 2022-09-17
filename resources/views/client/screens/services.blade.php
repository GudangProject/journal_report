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

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Bagian Tata Usaha </h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_tatausaha->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Bidang Pendidikan Agama dan Keagamaan Islam </h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_pendidikan_agama->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Bidang Pendidikan Madrasah </h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_pendidikan_madrasah->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Bidang Penyelenggaraan Haji dan Umrah </h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_hajidanumrah->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>


<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Bidang Bimbingan Masyarakat Islam</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_masyarakat->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Pembimbing Masyarakat Kristen</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_masyarakat_kristen->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Pembimbing Masyarakat Katolik</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_masyarakat_katolik->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Pembimbing Masyarakat Hindu</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_masyarakat_hindu->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Pembimbing Masyarakat Hindu</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_masyarakat_hindu->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home_section1 mb-4 mt-3">
    <div class="container">
        <div class="section-title">
            <h1>Grafik Layanan Pembimbing Masyarakat Budha</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mb-4">
                <div class="card card-profile p-3">
                    {!! $grafik_masyarakat_budha->container() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="{{ $donut_data ? $donut_data->cdn() : null }}"></script>

@if (!empty($donut_data) && !empty($grafik_masyarakat_budha) && !empty($grafik_masyarakat_hindu) && !empty($grafik_masyarakat_katolik) && !empty($grafik_masyarakat_kristen) && !empty($grafik_masyarakat) && !empty($grafik_hajidanumrah) && !empty($grafik_tatausaha) && !empty($grafik_pendidikan_agama) && !empty($grafik_pendidikan_madrasah))
    {{ $donut_data->script() }}
    {{ $grafik_tatausaha->script() }}
    {{ $grafik_pendidikan_agama->script() }}
    {{ $grafik_pendidikan_madrasah->script() }}
    {{ $grafik_hajidanumrah->script() }}
    {{ $grafik_masyarakat->script() }}
    {{ $grafik_masyarakat_kristen->script() }}
    {{ $grafik_masyarakat_katolik->script() }}
    {{ $grafik_masyarakat_hindu->script() }}
    {{ $grafik_masyarakat_budha->script() }}
@endif

@endpush

@endsection
