@extends('layouts.master-client')

@section('content')

<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row main_content">
            <div class="col-md-8  loop-large-post" id="content">
                <div class="widget_container content_page">
                    <!-- start post -->
                    <div class="post-2838 post type-post status-publish format-standard has-post-thumbnail hentry category-sports tag-gaming" id="post-2838">
                        <div class="single_section_content box blog_large_post_style">
                            <div class="jl_single_style2">
                                <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
                                    <span class="meta-category-small single_meta_category">
                                        <a class="post-category-color-text" style="background:#305b90" href="/"><i class="fa fa-home"></i></a>
                                    </span>
                                    <span class="meta-category-small single_meta_category">
                                        <a class="post-category-color-text" style="background:#305b90" href="#">
                                            <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </span>
                                    <span class="meta-category-small single_meta_category">
                                        <a class="post-category-color-text" style="background:#305b90" href="#">
                                        Photo</i>
                                        </a>
                                    </span>
                                    <div class="d-none d-lg-block d-xl-block">
                                        <span class="meta-category-small single_meta_category">
                                            <a class="post-category-color-text" style="background:#305b90" href="#">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </span>
                                        <span class="meta-category-small single_meta_category">
                                            <a class="post-category-color-text" style="background:#305b90" href="#">
                                            {{$data['parent']->title}}</i>
                                            </a>
                                        </span>
                                    </div>
                                    <h1 class="single_post_title_main">{{$data['parent']->title}}</h1>
                                    <span class="jl_post_meta">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-6">
                                                <span style="color:#305b90;font-style:italic;">{{\Carbon\Carbon::parse($data['parent']->created_at)->isoFormat('dddd, d MMMM Y');}} {{\Carbon\Carbon::parse($data['parent']->created_at)->format('H:i');}} WIB</span>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="jl_single_style2">
                                <div class="jl_slide_wrap_s jl_clear_at">
                                    <div class="jl_ar_top jl_clear_at">
                                        <div class="jl-w-slider jl_full_feature_w">
                                            <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">
                                                <div class="item-slide">
                                                    <div class="slide-inner">
                                                        <div class="jl_foto_center blog-style-one blog-small-grid">
                                                            <div class="jl_foto_center_w jl_radus_e" style="max-heigt: 350px!important;">
                                                                <div class="jl_f_img_bg" style="background-image: url('{{ $data['parent']->image }}');"></div>
                                                                <a data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $data['parent']->caption }}" href="#" class="jl_f_img_link"></a>
                                                                <span class="jl_post_type_icon">
                                                                    <i class="jli-gallery"></i>
                                                                </span>
                                                                <div class="text-box">
                                                                    <span class="jl_f_cat"><a class="post-category-color-text" style="background: #305b90;" href="#">Foto 1</a></span>
                                                                    <h3>
                                                                        <a data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $data['parent']->caption }}" href="#">{{ $data['parent']->caption }}</a>
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ($data['data_photo'] as $item)
                                                    <div class="item-slide">
                                                        <div class="slide-inner">
                                                            <div class="jl_foto_center blog-style-one blog-small-grid">
                                                                <div class="jl_foto_center_w jl_radus_e" style="max-heigt: 350px!important;">
                                                                    <div class="jl_f_img_bg" style="background-image: url('{{ $item->image }}');"></div>
                                                                    <a data-fancybox="gallery-a" data-fancybox data-type="image" data-caption="{{ $item->caption }}" href="#" class="jl_f_img_link"></a>
                                                                    <span class="jl_post_type_icon">
                                                                        <i class="jli-gallery"></i>
                                                                    </span>
                                                                    <div class="text-box">
                                                                        <span class="jl_f_cat"><a class="post-category-color-text" style="background: #305b90;" href="#">Foto {{ $loop->index+2 }}</a></span>
                                                                        <h3>
                                                                            <a data-fancybox="gallery-a" data-fancybox data-type="image" href="#">{{ $item->caption }}</a>
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post_content_w mt-4">
                                <div class="post_sw">
                                    <div class="post_s">
                                        <div class="jl_single_share_wrapper jl_clear_at">
                                            <ul class="single_post_share_icon_post">
                                                <li class="single_post_share_facebook">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{$data['parent']->url}}" target="_blank"><i class="jli-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="single_post_share_twitter">
                                                    <a href="https://twitter.com/intent/tweet?url={{$data['parent']->url}}" target="_blank"><i class="jli-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="single_post_share_whatsapp">
                                                    <a href="whatsapp://send?text={{$data['parent']->url}}" target="_blank"><i class="fab fa-whatsapp"></i>
                                                    </a>
                                                </li>
                                                <li class="single_post_share_linkedin">
                                                    <a onClick="myCopy()"><i class="jli-link"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="post_content jl_content">
                                    {!! $data['parent']->content !!}
                                    <hr>
                                    <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
                                        <span class="jl_post_meta">
                                            <ul class="entry__meta" style="padding: 0px;">

                                            </ul>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="brack_space"></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$popular, 'limit'=>4])
                {{-- @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4]) --}}
                {{-- @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4]) --}}
                <hr>
                {{-- @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4]) --}}
            </div>
        </div>
        {{-- @include('client.widget.list-image-rows', ['data'=> $posts, 'limit'=>8, 'title'=>$data['parent']->getCategory->name.' LAINNYA']) --}}
    </div>
</section>

@section('scripts')
<script>
    function myCopy() {
        var dummy = document.createElement('input'),
            text = window.location.href;
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
    }
</script>
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
@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" type="text/css" media="screen" />
@endpush
