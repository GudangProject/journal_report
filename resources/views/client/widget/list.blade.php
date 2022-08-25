@if(isset($data))
    <div class="section-title home_section1">
        <h1 class="text-uppercase"><a href="{{ $slug ?? '/informasi' }}">{{ $title }}</a></h1>
    </div>
    @foreach ($data as $item)
        <div class="card p-0 shadow-sm" style="margin-bottom: 10px;">
            <div class="card-body p-1">
                <h3 class="title-card">
                    <a href="{{ $item->url }}" tabindex="-1">{{ $item->judul }}</a>
                </h3>
            </div>
        </div>
    @if($loop->index == $limit)
        @break
    @endif
    @endforeach
    @if($limit)
    <div class="mt-4">
        <a href="{{ url('informasi') }}">
            <span class="badge d-block badge-light-primary">Selengkapnya <i class="fas fa-arrow-right"></i></span>
        </a>
    </div>
    @endif
@endif
