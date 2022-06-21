@if(isset($data))
<div class="section-title">
    <h1 class="text-uppercase">{{ $title }}</h1>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
    @php($count=0)
    @foreach ($data as $item)
    @if($item['published_at'] < now())
        @php($count++)
        <div class="card p-0 shadow-sm" style="margin-bottom: 10px;">
            <div class="card-body p-1">
                <div class="row align-items-center">
                    <div class="col-3 p-0 pl-3">
                        <a href="{{ $item->url }}">
                            <img src="{{ is_file(public_path($item->images['thumbnail'])) ? $item->images['thumbnail'] : '/storage/images/default.jpg' }}" alt="{{ $item->title }}" class="rounded">
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
        @if($count == $loop->count/2)
            @break
        @endif
        @php($index = $loop->iteration)
    @endif
    @endforeach
    </div>
    <div class="col-md-6 col-sm-12">
    @foreach ($data as $item)

        @if($loop->index < $index+1)
            @continue
        @endif
        @php($count++)
        <div class="card p-0 shadow-sm" style="margin-bottom: 10px;">
            <div class="card-body p-1">
                <div class="row align-items-center">
                    <div class="col-3 p-0 pl-3">
                        <a href="{{ $item->url }}">
                            <img src="{{ is_file(public_path($item->images['thumbnail'])) ? $item->images['thumbnail'] : '/storage/images/default.jpg' }}" alt="{{ $item->title }}" class="rounded">
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
        @if($count == $loop->count)
            @break
        @endif
        @endforeach
    </div>
</div>
@endif
