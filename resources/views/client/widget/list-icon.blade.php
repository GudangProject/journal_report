@if(isset($data))
<div class="section-title">
    <h1>{{ $title }}</h1>
</div>
@foreach ($data as $item)
    <div class="cardx p-0 shadow-none" style="margin-bottom: 10px;">
        <div class="card-body p-1">
            <div class="row align-items-start justify-content-center">
                <div class="col-2 pr-0">
                    <h3 class="bullet_number">{{ $loop->index+1 }}</h3>
                </div>
                <div class="col-10 pl-0">
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
    @if($loop->index == 4)
        @break
    @endif
@endforeach
@endif
