@if($data)
<section class="home_section1">
    <div class="section-title">
        <h1><a href="{{ $slug ?? '/podcasts' }}">{{ $title }}</a></h1>
    </div>
    <div class="jl-w-slider jl_full_feature_w mb-4">
        <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">
            @foreach ($data as $item)
                    <a href="/video/{{$item['slug']}}">
                        <div class="item-slide jl_radus_e">
                            <div class="slide-inner">
                                <span class="jl_post_type_icon"><i class="jli-youtube"></i></span>
                                <img src="{{ $item->image['medium'] }}" alt=""/>
                            </div>
                        </div>
                    </a>
            @endforeach
        </div>
    </div>
</section>
@endif
