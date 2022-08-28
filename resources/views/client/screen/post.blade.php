@extends('layouts.master-client')

@section('content')

<section id="content_main" class="clearfix jl_spost">
    <div class="container">
        <div class="row main_content">
            <div class="col-md-8  loop-large-post" id="content">
                <div class="widget_container content_page">
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
                                            {{$data->title}}</i>
                                            </a>
                                        </span>
                                    </div>
                                    <h6><span class="badge badge-light-primary">{{$data->prefix}}</span></h6>
                                    <h1 class="single_post_title_main">{{$data->title}}</h1>
                                    <span class="jl_post_meta">
                                        <div class="row align-items-center">
                                            <div class="col-md-8 col-6">
                                                <ul class="entry__meta" style="padding: 0px;">
                                                    @if ($data->getAuthor($data->id))
                                                    @foreach($data->getAuthor($data->id) as $a=>$b)
                                                        @if($b['code'] === 'k')
                                                        <li class="author-avatar penulis-info">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <img class="pic alignnone photo" alt="" src="{{$b['avatar']}}" style="max-width: 30px">
                                                                </div>
                                                                <div class="col-9">
                                                                    <a href="{{$b['url']}}">
                                                                        <span class="entry-author__name">{!!$b['name']!!}
                                                                            <i class="fa fa-check-circle" style="color:#305b90;"></i>
                                                                        </span>
                                                                    </a>
                                                                    <br>
                                                                    <span style="font-size: 12px">{{ $b['type'] }}</span>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        @endif
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <ul class="entry__meta text-right">
                                                    <li class="entry__meta-date">
                                                        <span style="color:#305b90;">{{$data->date_time}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                <div class="single_content_header jl_single_feature_below">
                                    <div class="">
                                        <img width="1000" height="650" src="{{ is_file(public_path($data->images['full'])) ? $data->images['full'] : '/storage/images/default-full.jpg' }}" class="" alt="" loading="lazy">
                                    </div>
                                </div>

                            </div>
                            <span class="text-secondary">{{$data['caption']}}</span>
                            <div class="post_content_w mt-4">
                                @include('client.widget.share')
                                <div class="post_content jl_content">
                                    {!!$data['content']!!}
                                    <hr>
                                    <div class="single_post_entry_content single_bellow_left_align jl_top_single_title jl_top_title_feature">
                                        <span class="jl_post_meta">
                                            <ul class="entry__meta" style="padding: 0px;">
                                                @if ($data->getAuthor($data->id))
                                                @foreach($data->getAuthor($data->id) as $a=>$b)
                                                    @if($b['code'] != 'k')
                                                    <li class="author-avatar penulis-info">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <img class="pic alignnone photo" alt="" src="{{$b['avatar']}}" style="max-width: 30px">
                                                            </div>
                                                            <div class="col-9">
                                                                <a href="{{$b['url']}}" style="text-decoration: none !important;">
                                                                    <span class="entry-author__name">{!!$b['name']!!}
                                                                        <i class="fa fa-check-circle" style="color:#305b90;"></i>
                                                                    </span>
                                                                </a>
                                                                <br>
                                                                <span style="font-size: 12px">{{ $b['type'] }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="single_tag_share ">
                                <div class="tag-cat">
                                    <ul class="single_post_tag_layout">
                                    @foreach(explode(', ', $data->tags) as $tag)
                                        <li>
                                            <a href="/tags/{{ $tag }}">{{$tag}}</a>
                                        </li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('client.widget.list-linkage', ['data'=> $data->getLinkage, 'limit'=>6, 'title'=>'TERKAIT'])
                </div>
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$popular, 'limit'=>4])
                @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                <hr>
                @include('client.widget.embed', ['title'=> "FANPAGE"])
                {{-- @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4]) --}}
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
