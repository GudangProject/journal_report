@extends('layouts.master-client')

@section('content')
    <section class="home_section1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 mb-4">
                    <section>
                        <div class="section-title">
                            <h1>BIDANG LAYANAN</h1>
                        </div>
                        <div class="row">
                            @foreach ($data as $item)
                            <div class="col-md-3 col-12" style="margin-top: 10px">
                                <div class="card card-profile">
                                    <div class="card-body p-3 text-left">
                                        <span class="title-card mb-3">
                                            <a href="#" tabindex="-1">{{ $item->getService->nama_layanan }}</a>
                                        </span>
                                        <strong>{{ $item->total_layanan }}</strong>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $item->total_layanan }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                          </div>
                                        <a class="btn btn-sm btn-primary mt-4 p-2 btn-block">Ajukan Layanan Permohonan <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($){
          $("#sidebar-post").sticky({ topSpacing: 50 });
          $('#sidebar-post').on('sticky-bottom-reached', function() {
            $("#sidebar-post").sticky({ bottomSpacing: 500 });
           });
        });
</script>
@stop
@endsection
