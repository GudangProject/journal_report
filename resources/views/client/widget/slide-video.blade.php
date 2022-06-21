@if($data)
<div class="section-title">
    <h1><a href="/videos">{{ $title }}</a></h1>
</div>
<div class="jl-w-slider jl_full_feature_w">
    <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="false" data-swipe="true" data-items="2" data-xs-items="2" data-sm-items="2" data-md-items="2" data-lg-items="4" data-xl-items="4">
        @foreach ($data as $item)
        <div class=" item-slide jl_m_center_w jl_radus_e">
            <div class="slide-inner m-1">
                <div class="card-mod jl_grid_w shadow-sm">
                    <div class="jl_img_box jl_radus_e">
                        <a href="/video/{{$item['slug']}}"> <span class="jl_post_type_icon"><i class="jli-youtube"></i></span>
                            <img width="500" height="350" src="https://img.youtube.com/vi/{{$item['youtube_id']}}/maxresdefault.jpg" class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image" alt="" loading="lazy">
                        </a>
                    </div>
                    <span class="jl_post_meta pl-2">
                        <span class="post-date" style="color:#305b90;">{{ $item->date }}</span>
                    </span>
                    <div class="video-text pl-2 pr-2 pb-2">
                        <h3><a href="/video/{{$item['slug']}}">{{$item['title']}}</a></h3>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
