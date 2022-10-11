@if($data)
<div class="jl-w-slider jl_full_feature_w mb-4">
    <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="false" data-swipe="true" data-items="4" data-xs-items="2" data-sm-items="2" data-md-items="4" data-lg-items="4" data-xl-items="4">
        @foreach ($data as $item)
        <div class="item-slide jl_radus_e">
            {{-- <div class="slide-inner">
                <div class="card p-0 m-2 shadow-sm">
                    <div class="card-body p-2"> --}}
                        <div class="d-flex justify-content-center">
                            <a href="{{ $item->slug }}">
                                <img src="{{ is_file(public_path($item->image)) ? $item->image : '/assets/images/thumb.png' }}" alt="" />
                            </a>
                        {{-- </div>
                    </div>
                </div> --}}
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
