@extends('layouts.master-client')
@section('content')

    <section class="home_section1">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    @include('client.widget.banner-small', ['data'=>$main_services])
                    @include('client.widget.slide', ['data'=>$headline, 'limit'=>4])
                    @include('client.widget.sholat')
                    @include('client.widget.banner-home', ['data'=>$banner_home])
                    @include('client.widget.list-row2', ['title'=>'BERITA TERBARU', 'data'=>$terbaru, 'limit'=>8])
                    @include('client.widget.slide-video', ['title'=>'VIDEO', 'data'=>$video])
                    @include('client.widget.list-row2', ['title'=> "BERITA DAERAH", 'data'=> $wilayah, 'limit'=>8])
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="theiaStickySidebar">
                    @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$wilayah, 'limit'=>4])
                    @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>3])
                    @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                    <hr>
                    @include('client.widget.list', ['title'=>'INFO KEPEGAWAIAN', 'data'=> $data_kepegawaian, 'category_id' => 3, 'limit'=>2])
                    @include('client.widget.embed', ['title'=> "FANPAGE"])
                    </div>
                </div>
            </div>
            @include('client.widget.slide-video-custom', ['title'=>'VIDEO', 'data'=>$video])
            @include('client.widget.slide-card', ['title'=>'LAYANAN', 'data'=>$services, 'status'=>true])
            @include('client.widget.kemenag-dalam-angka', ['title'=>'KEMENAG DALAM ANGKA', 'data'=>$services, 'status'=>true])
        </div>
    </section>

@endsection
