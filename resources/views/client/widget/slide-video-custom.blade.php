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
                <span class="video-title"><strong>Profil Sulbar Kemenag</strong></span>
                <a data-fancybox="video-gallery" href="https://www.youtube.com/watch?v=TboWOSW7qCI">
                    <img src="https://img.youtube.com/vi/TboWOSW7qCI/maxresdefault.jpg" class="video-thumbnail" alt="">
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
