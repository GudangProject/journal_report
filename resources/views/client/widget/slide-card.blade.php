<section class="">
    <div class="section-title">
        <h1><a href="{{ $slug ?? '/layanan' }}">{{ $title }}</a></h1>
    </div>
    <div class="jl-w-slider jl_full_feature_w">
        <div class="jl-eb-slider jelly_loading_pro" data-arrows="true" data-play="true" data-effect="false" data-speed="500" data-autospeed="7000" data-loop="true" data-dots="false" data-swipe="true" data-items="4" data-xs-items="2" data-sm-items="2" data-md-items="4" data-lg-items="4" data-xl-items="4">
            @foreach ($data as $item)
            <div class="item-slide" style="margin-top: 60px;">
                {{-- <div class="slide-inner"> --}}
                    <div class="container">
                        <div class="card card-profile shadow-sm">
                            <div class="card-body p-1">
                                <div class="profile-image-wrapper">
                                    <div class="profile-image">
                                        <div class="avatar">
                                            <img src="{{ is_file(public_path($item->image)) ? $item->image : '/assets/images/thumb.png' }}" alt="Card Picture">
                                        </div>
                                    </div>
                                </div>
                                <h3 class="title-card" style="padding-top: 60px;">
                                    <a href="#" tabindex="-1">{{ $item->title }}</a>
                                </h3>
                                <div class="font-small">
                                    <span class="text-muted">{{ $item->description }}</span>
                                </div>
                                <a href="{{ $item->slug }}">
                                    <span class="badge badge-light-primary profile-badge">Kunjungi Layanan <i class="fas fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            @endforeach
        </div>
    </div>
</section>
