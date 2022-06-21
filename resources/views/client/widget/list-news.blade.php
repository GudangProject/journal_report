@if(isset($data))
    <div class="section-title">
        <h1>{{ $title }}</h1>
    </div>
    @foreach ($data as $item)
    <div class="card p-0" style="margin-bottom: 10px;">
        <div class="card-body p-1">
            <span class="badge badge-light-primary">
                {{ $item->getCategory->name }}
            </span>
            <h3 class="title-card">
                <a href="{{ $item->url }}" tabindex="-1">{{ $item->judul }}</a>
            </h3>
            {{-- <span class="jl_post_meta">
                <span class="post-date" style="color:#305b90;">{{ $item->published_at ?? $item->created_at }}</span>
            </span> --}}
        </div>
    </div>
    @if($loop->index == $limit)
        @break
    @endif
    @endforeach
    @if($status)
    <div class="mt-4">
        <a href="{{ url('informasi') }}">
            <span class="badge d-block badge-light-primary">Selengkapnya <i class="fas fa-arrow-right"></i></span>
        </a>
    </div>
    @endif
@endif
