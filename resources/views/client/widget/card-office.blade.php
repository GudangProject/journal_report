@if(isset($data))
<div class="section-title">
    <h1>{{ $title }}</h1>
</div>

<div class="">
    <div class="row">
        @foreach ($data as $item)
        <div class="col-md-4">
            <div class="card-mod jl_grid_w">
                <div class="jl_img_box jl_radus_e">
                    <a href="{{ $item->url }}">
                        <img width="500" height="350" src="{{ $item->image['medium'] }}" class="attachment-sprasa_slider_grid_small size-sprasa_slider_grid_small wp-post-image" alt="" loading="lazy">
                    </a>
                </div>

                <div class="video-text p-2">
                    <span class="badge badge-light-primary">
                        {{ $item->getCategory->name }}
                    </span>
                    <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
                </div>
            </div>
        </div>
        @if($loop->index == $limit)
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
