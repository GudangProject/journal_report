@extends('layouts.master-client')

@section('content')
<section class="home_section1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                @include('client.widget.list-static')
            </div>
            <div class="col-md-4 col-sm-12 sidebar">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$popular, 'limit'=>4])
                @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                <hr>
                @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
            </div>
        </div>
    </div>
</section>
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function() {
            jQuery('.content, .sidebar').theiaStickySidebar({
            additionalMarginTop: 75
            });
            jQuery('.content, .post_sw').theiaStickySidebar({
            additionalMarginTop: 100
            });
        });
</script>
@stop
@endsection
