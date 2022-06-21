<section>
    <div class="section-title">
        <h1>{{ $title }}</h1>
    </div>
    <div class="row">

        @foreach ($data as $item)
        <div class="col-md-3 col-12" style="margin-top: 60px">
            <div class="card card-profile">
                <div class="card-body p-1">
                    <div class="profile-image-wrapper">
                        <div class="profile-image">
                            <div class="avatar">
                                <img src="{{ $item->image }}" alt="Card Picture">
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
        @endforeach

    </div>
    @if ($status)
    <a href="{{ url('layanan') }}">
        <span class="badge d-block badge-light-primary">Selengkapnya <i class="fas fa-arrow-right"></i></span>
    </a>
    @endif
</section>
