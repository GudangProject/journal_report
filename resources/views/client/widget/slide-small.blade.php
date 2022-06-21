@if(isset($data))
<section class="home_section1">
    <div class="section-title">
        <h1><a href="{{ $slug ?? '/infografis' }}">{{ $title }}</a></h1>
    </div>
    <div class="jl-w-slider jl_full_feature_w">
        <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">
            @php($count = 0)
            @foreach($data as $item)
            @php($count++)
            <div class="item-slide">
                <div class="slide-inner">
                    <div class="jl_grid_overlay jl_w_menu jl_clear_at">
                        <div class="jl_grid_overlay_col">
                            <div class="jl_grid_verlay_wrap jl_radus_e">
                                <a href="{{ url($item->image) }}">
                                <div class="jl_f_img_bg" style="background-image: url('{{ $item->image }}');"></div>
                                <a href="{{ $item->image }}" download>
                                    <span class="jl_post_type_icon"><i class="jli-gallery"></i></span>
                                </a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($count == $limit)
                @break
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif
