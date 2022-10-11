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
                                <a href="/photo/{{ $item->slug }}">
                                <div class="jl_f_img_bg" style="background-image: url('{{ is_file(public_path($item->image)) ? $item->image : '/assets/images/thumb.png' }}');"></div>
                                <a href="/photo/{{ $item->slug }}" download>
                                    <span class="jl_post_type_icon"><i class="jli-gallery"></i></span>
                                </a>
                                <div class="jl_f_postbox">
                                    <h3 class="jl_f_title">
                                        <a href="/photo/{{ $item->slug }}" tabindex="-1">{!! $item->title !!}</a>
                                    </h3>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($count == 5)
                @break
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif
