@if($data)
<div class="jl-w-slider jl_full_feature_w mb-4">
    <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-xs-items="1" data-sm-items="1" data-md-items="1" data-lg-items="1" data-xl-items="1">
        @foreach ($data as $item)
        <div class="item-slide jl_radus_e">
            <div class="slide-inner">
                <img src="{{ $item->image }}" alt=""/>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
