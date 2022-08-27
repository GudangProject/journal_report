@extends('layouts.master-client')

@section('content')
<section class="home_section1">

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="ettitle jl_cat_mid_title text-center widget-title">
                    <h4 class="categories-title title jl_title_c">Kumpulan Foto </h4>
                </div>
                <div class="widget_jl_wrapper">
                    <div class="bt_post_widget">
                        <div class="row">
                            @if (isset($data))
                                @foreach ($data as $item)
                                    <div class="col-md-6 mb-4">
                                        <div class="jl_topik_center blog-style-one blog-small-grid">
                                            <div class="jl_topik_center_w jl_radus_e" style="max-heigt: 350px!important;">
                                                <div class="jl_f_img_bg" style="background-image: url('{{ $item->image }}');"></div>
                                                <a href="/photo/{{ $item->slug }}" class="jl_f_img_link"></a>
                                                <span class="jl_post_type_icon">
                                                    <i class="jli-gallery"></i>
                                                </span>
                                                <div class="text-box">
                                                    <span class="jl_f_cat"><a class="post-category-color-text" style="background: #305b90;" href="/photo/{{ $item->slug }}">Foto</a></span>
                                                    <h3>
                                                        <a href="/photo/{{ $item->slug }}">{{ $item->title }}</a>
                                                    </h3>
                                                </div>
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
                {{-- @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4]) --}}
                <hr>
                {{-- @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4]) --}}
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
