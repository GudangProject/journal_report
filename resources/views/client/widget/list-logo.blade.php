@if(isset($data))
<div class="section-title">
    <h1>{{ $title }}</h1>
</div>
@foreach ($data as $item)
    <div class="card p-0" style="margin-bottom: 10px;">
        <div class="card-body p-1">
            <div class="row align-items-center">
                <div class="col-2 p-0">
                    <a href="{{ $item->url }}">
                        <img src="{{ asset('assets/img/favicon.png') }}" alt="{{ $item->title }}" class="rounded" style="width: 80px">
                    </a>
                </div>
                <div class="col-10">
                    <span class="badge badge-light-primary">
                        {{ $item->getCategory->name }}
                    </span>
                    <h3 class="title-card">
                        <a href="{{ $item->url }}" tabindex="-1">{{ $item->title }}</a>
                    </h3>
                    <span class="jl_post_meta">
                        <span class="post-date" style="color:#305b90;">{{ $item->published_at }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
    @if($loop->index == 4)
        @break
    @endif
@endforeach
<div class="mt-4">
    <a href="">
        <span class="badge d-block badge-light-primary">Selengkapnya <i class="fas fa-arrow-right"></i></span>
    </a>
</div>
@endif
