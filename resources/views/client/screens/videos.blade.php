@extends('layouts.master-client')

@section('content')
<section class="home_section1">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="section-title">
                    <h1>KUMPULAN VIDEO {{ $title }}</h1>
                </div>
                <div class="widget_jl_wrapper">
                    <div class="bt_post_widget">
                        <div class="row">
                            @if (isset($data))
                                @foreach ($data as $item)
                                    <div class="col-md-6">
                                        <div class="card-mod jl_grid_w">
                                            <div class="jl_img_box jl_radus_e">
                                                <a href="/video/{{ $item->slug }}"> <span class="jl_post_type_icon"><i class="jli-youtube"></i></span>
                                                    <img width="500" height="350" src="{{ $item->image['medium'] }}" class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image" alt="{!! $item->title !!}" loading="lazy">
                                                </a>
                                            </div>
                                            <div class="video-text pl-3 pr-3 pb-2">
                                                <h3><a href="/video/{{ $item->slug }}">{!! $item->title !!}</a></h3>
                                                <span class="jl_post_meta">
                                                    <span class="post-date">{{\Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, d MMMM Y');}} {{\Carbon\Carbon::parse($item->created_at)->format('H:i');}} WIB</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $data->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$popular, 'limit'=>4])
                @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                <hr>
                @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
            </div>
        </div>
    </div>
</section>
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function() {
            jQuery('.content, .sidebar').theiaStickySidebar({
            additionalMarginTop: 75
            });
            jQuery('.content, .post_sw').theiaStickySidebar({
            additionalMarginTop: 100
            });
        });
</script>
@stop
@endsection
