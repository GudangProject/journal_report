@if(isset($data))
<div class="section-title">`
    <h1>Hasil <span class="text-primary">#{{ $title }}</span></h1>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        @foreach ($data as $item)
        <div class="card p-0" style="margin-bottom: 10px;">
            <div class="card-body p-1">
                <div class="row align-items-center">
                    <div class="col-3 p-0 pl-3">
                        <a href="{{ $item->url }}">
                            <img src="{{ is_file(public_path($item->image['thumbnail'])) ? $item->image['thumbnail'] : '/storage/images/default.jpg' }}" alt="{{ $item->title }}" class="rounded">
                        </a>
                    </div>
                    <div class="col-9 pl-2">
                        <h3 class="title-card">
                            <a href="{{ $item->url }}" tabindex="-1">{{ $item->title }}</a>
                        </h3>
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
        </div>
        @if($loop->index == 9)
            @break
        @endif
        @endforeach
    </div>
    <div class="col-md-6 col-sm-12">
        @foreach ($data as $item)
        @if($loop->index < 10)
            @continue
        @endif
        <div class="card p-0" style="margin-bottom: 10px;">
            <div class="card-body p-1">
                <div class="row align-items-center">
                    <div class="col-3 p-0 pl-3">
                        <a href="{{ $item->url }}">
                            <img src="{{ is_file(public_path($item->image['thumbnail'])) ? $item->image['thumbnail'] : '/storage/images/default.jpg' }}" alt="{{ $item->title }}" class="rounded">
                        </a>
                    </div>
                    <div class="col-9 pl-2">
                        <h3 class="title-card">
                            <a href="{{ $item->url }}" tabindex="-1">{{ $item->title }}</a>
                        </h3>
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
        </div>
        @if($loop->index == 7)
            @break
        @endif
        @endforeach
    </div>
</div>
{{-- <div class="mt-3 mb-4">
    <a href="">
        <span class="badge d-block badge-light-primary">Selengkapnya <i class="fas fa-arrow-right"></i></span>
    </a>
</div> --}}
@endif
