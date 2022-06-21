@if(isset($data))
    <div class="section-title">
        <h1 class="text-uppercase">{{ $title }}</h1>
    </div>
    <div class="row">
    @foreach ($data as $item)
    <div class="col-md-6 col-12">
        <div class="card p-0" style="margin-bottom: 10px;">
            <div class="card-body p-1">
                <h3 class="title-card">
                    <a href="{{ $item->url }}" tabindex="-1">{{ $item->title }}</a>
                </h3>
                <span class="jl_post_meta">
                    <span class="post-date" style="color:#305b90;">{{ $item->published_at ?? $item->created_at }}</span>
                </span>
            </div>
        </div>
    </div>
    @endforeach
    </div>
@endif
