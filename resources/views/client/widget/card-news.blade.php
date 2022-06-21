@if(isset($data))
<div class="section-title home_section1">
    <h1 class="text-uppercase">{{ $title }}</h1>
</div>

<div class="">
    <div class="row">
        @foreach ($data as $item)
        <div class="col-md-3 col-6">
            <div class="card-mod jl_grid_w">
                <div class="jl_img_box jl_radus_e">
                    <a href="{{ $item->url }}">
                        <img width="500" height="350" src="{{ $item->images['medium'] }}" class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image" alt="" loading="lazy">
                    </a>
                </div>

                <div class="video-text p-2">
                    <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
                    <span class="jl_post_meta">
                        <span class="text-primary">
                            {{ $item->getCategory->name }}
                        </span>
                        <span> | </span>
                        <span class="post-date" style="color:#647277;">{{ $item->date }}</span>
                    </span>
                </div>
            </div>
        </div>
        @if($loop->index == 3)
            @break
        @endif
        @endforeach
    </div>
</div>

@if($status)
<div class="mt-4">
    <a href="">
        <span class="badge d-block badge-light-primary">Selengkapnya <i class="fas fa-arrow-right"></i></span>
    </a>
</div>
@endif
@endif
