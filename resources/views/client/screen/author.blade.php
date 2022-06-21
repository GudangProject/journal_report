@extends('layouts.master-client')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 mt-4">
            <div class="jl_cat_mid_title text-center">
                <img class="pic alignnone photo rounded" alt="" src="{{ isset($author->image) ? '/storage/pictures/users/mid/'.$author->image : asset('assets/images/dummy-image.jpeg') }}" style="max-width: 200px" >
                <p>&nbsp;</p>
                <h4 class="categories-title title">{{ $author->name }} <i class="fa fa-check-circle" style="color:#305b90;">
                </i></h4>
                <p style="max-width: 100%;margin-top:15px;">
                    @php
                        $user_type = explode(',', $author->user_type);
                    @endphp
                    @foreach ($user_type as $type)
                        <span class="badge badge-light-primary">{{ config('app.user_type')[$type] }}</span>
                    @endforeach
                </p>
            </div>

            @include('client.widget.list-authors', ['data'=>$data])

            <div class="d-flex justify-content-center mt-4 mb-3">
                {{ $data->onEachSide(0)->links() }}
            </div>

        </div>
        <div class="col-md-4 col-sm-12 mb-2">
            @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$populer, 'limit'=>4])
            @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
            @include('client.widget.slide-small', ['title'=>'INFOGRAFIS'])
            @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
        </div>
    </div>
</div>
@endsection
