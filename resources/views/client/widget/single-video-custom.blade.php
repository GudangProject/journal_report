@section('styles')
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
/>
@endsection
@if($data)
<div class="row mt-4">
    <div class="col-12 d-flex justify-content-center">
        <div class="bg-video">
            <div class="video-card">
                <span class="video-title"><strong>Profil Kanwil Kemenag Sulbar</strong></span>
                <a data-fancybox="video-gallery" href="https://www.youtube.com/watch?v={{ $data[0]->youtube_id }}">
                    <img src="https://img.youtube.com/vi/{{ $data[0]->youtube_id }}/maxresdefault.jpg" class="video-thumbnail" alt="">
                    <div class="video-overlay">
                        <b class="video-icon-play" title="Video">
                            <i class="fa fa-play-circle"></i>
                        </b>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
@endpush
@endif
