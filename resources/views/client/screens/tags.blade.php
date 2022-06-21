@extends('layouts.master-client')

@section('content')
<section class="home_section1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                @include('client.widget.list-row2', ['data'=>$data, 'title'=> $title])
                <div class="d-flex justify-content-center">
                    {{ $data->onEachSide(2)->links() }}
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-2">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$headline, 'limit'=>4])
                @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS'])
                <hr>
                @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
            </div>
        </div>
    </div>
</section>
@endsection
