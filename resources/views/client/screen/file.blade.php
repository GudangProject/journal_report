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
                                        <a class="post-category-color-text" style="background:#305b90" href="/{{$data->getCategory->slug}}">{{$data->getCategory->name}}</a>
                                    </span>
                                    <div class="d-none d-lg-block d-xl-block">
                                        <span class="meta-category-small single_meta_category">
                                            <a class="post-category-color-text" style="background:#305b90" href="#">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </span>
                                        <span class="meta-category-small single_meta_category">
                                            <a class="post-category-color-text" style="background:#305b90" href="#">
                                            {{$data->judul}}</i>
                                            </a>
                                        </span>
                                    </div>
                                    <h6><span class="badge badge-light-primary">{{$data->prefix}}</span></h6>
                                    <h1 class="single_post_title_main">{{$data->title}}</h1>
                                    <span class="jl_post_meta">
                                        <ul class="entry__meta text-right">
                                            <li class="entry__meta-date">
                                                <span style="color:#305b90;">{{$data->published_at}}</span>
                                            </li>
                                        </ul>
                                    </span>
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="avatar bg-light-info rounded mb-1 p-5">
                                    <div class="avatar-content">
                                        <i class="fas fa-file-alt font-medium-5"></i>
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
                                    <p>{{$data->description}}</p>
                                    {{-- <div class="text-center mt-3 mb-3">
                                        <a href="{{ $data->url_file }}" class="btn btn-primary">
                                            <span>Lihat Selengkapnya <i class="fas fa-arrow-right"></i></span>
                                        </a>
                                    </div> --}}
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    @foreach ($data_file as $item)
                                                        <tr>
                                                            <td>
                                                                {{-- <span class="badge badge-pill badge-light-primary">{{ $k+1 }}</span> --}}
                                                                <span class="">{{ $item->name }}</span>
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge badge-pill badge-light-primary mr-1"><i class="fas fa-file"></i></span>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{ $item->url_file }}" target="_blank"><span class="badge badge-primary">Lihat <i class="fas fa-eye"></i></span></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
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
                @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                <hr>
                @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
            </div>
        </div>
        @include('client.widget.list-image-rows', ['data'=> $posts, 'limit'=>8, 'title'=>$data->getCategory->name.' LAINNYA'])
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
