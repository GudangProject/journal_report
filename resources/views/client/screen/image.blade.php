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
                                        Infografis</i>
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
                                            {{$data->title}}</i>
                                            </a>
                                        </span>
                                    </div>
                                    <h1 class="single_post_title_main">{{$data->title}}</h1>
                                    <span class="jl_post_meta">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-6">
                                                <span style="color:#305b90;font-style:italic;">{{\Carbon\Carbon::parse($data->created_at)->isoFormat('dddd, d MMMM Y');}} {{\Carbon\Carbon::parse($data->created_at)->format('H:i');}} WIB</span>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="jl_single_style2">
                                <div class="single_content_header jl_single_feature_below">
                                    <div class="image-post-thumb jlsingle-title-above">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $data->youtube_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="post_content_w mt-4">
                                <div class="post_sw">
                                    <div class="post_s">
                                        <div class="jl_single_share_wrapper jl_clear_at">
                                            <ul class="single_post_share_icon_post">
                                                <li class="single_post_share_facebook">
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{$data->url}}" target="_blank"><i class="jli-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="single_post_share_twitter">
                                                    <a href="https://twitter.com/intent/tweet?url={{$data->url}}" target="_blank"><i class="jli-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="single_post_share_whatsapp">
                                                    <a href="whatsapp://send?text={{$data->url}}" target="_blank"><i class="fab fa-whatsapp"></i>
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
                                    {!!$data['content']!!}
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
            <div class="col-md-4 col-sm-12 mb-2">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$headline, 'limit'=>4])
                @include('client.widget.list', ['title'=>'INFORMASI','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS'])
                @include('client.widget.medsos', ['title'=>'SOSIAL MEDIA'])
            </div>
        </div>
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
@stop

@endsection
