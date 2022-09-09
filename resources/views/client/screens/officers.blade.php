@extends('layouts.master-client')

@section('content')
<section class="home_section1">
    <div class="container">
        <div class="section-title">
            <h1 class="text-uppercase">{{ $title }}</h1>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    @foreach ($data as $item)
                        <div class="col-lg-{{ $item->order > 2 ? '3' : '12' }} col-sm-12 d-flex justify-content-center mb-3">
                            <div class="card">
                                <div class="card-body d-flex justify-content-center">
                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="rounded" style="width:150px;height:150px;">
                                </div>
                                <div class="card-footer text-center">
                                    <strong>{{ $item->name }}</strong>

                                    {!! $item->position !!}
                                    <div>
                                        <button class="btn btn-primary btn-block" data-fancybox="dialog" data-src="#dialog-content{{ $item->id }}">BIOGGRAFI</button>
                                        <div id="dialog-content{{ $item->id }}" style="display:none;">
                                            <img src="{{ $item->image }}" alt="{{ $item->name }}" class="rounded" style="width:150px;height:150px;">
                                            {!! $item->description !!}
                                        </div>
                                        <div class="modal fade" style="z-index: 9999;" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Profil Pejabat</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="rounded" style="width:150px;height:150px;">
                                                    {!! $item->description !!}
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- @include('client.widget.list-static') --}}
            </div>
            {{-- <div class="col-md-4 col-sm-12 sidebar">
                @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$popular, 'limit'=>4])
                @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                <hr>
                @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
            </div> --}}
        </div>
    </div>
</section>
@section('scripts')
<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
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
