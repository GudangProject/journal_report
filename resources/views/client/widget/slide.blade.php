<section class="home_section1">
    <div class="jl_m_center blog-style-one blog-small-grid">
        <div class="jl-w-slider jl_full_feature_w">
            <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="true" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">

            @if(isset($data))
                @php($count = 0)
                @foreach($data as $item)
                @if($item->published_at < now())
                @php($count++)
                <div class="item-slide jl_m_center_w jl_radus_e">
                    <div class="slide-inner">
                        <div class="jl_m_center_w jl_radus_e">
                            <div class="jl_f_img_bg" style="background-image: url('{{$item->images['full']}}');"></div>
                            <a href="{{ $item->url }}" class="jl_f_img_link"></a>
                            <div class="text-box">
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-primary">
                                        {{ $item->getCategory->name }}
                                    </span>
                                    <span class="jl_post_meta pl-2 pb-3">
                                        <span class="post-date" style="color:#305b90;">{{ $item->date }}</span>
                                    </span>
                                </div>

                                <h3>
                                    <a href="{{ $item->url }}">{{$item->title}}</a>
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($count == $limit)
                    @break
                @endif
                @endforeach
            @endif

            </div>
        </div>
    </div>
</section>
