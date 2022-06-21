@extends('layouts.master-client')

@section('content')
    <section class="home_section1">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12">
                    <div class="section-title">
                        <h1>ARSIP</h1>
                    </div>
                    <section id="accordion-with-margin">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card collapse-icon">
                                    <div class="card-body p-0">
                                        <div class="collapse-margin" id="accordionExample">
                                            @foreach ($data as $item)
                                            <div class="card">
                                                <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    <span class="lead collapse-title text-uppercase"> {{ $item->name }} </span>
                                                </div>

                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                    @forelse ($item->getFiles as $k=>$v)
                                                                    <tr>
                                                                        <td>
                                                                            <span class="badge badge-pill badge-light-primary">{{ $k+1 }}</span>
                                                                            <span class="">{{ $v->title }}</span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span class="text-primary" style="font-size: 12px">{{ $v->created_at }}</span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span class="badge badge-pill badge-light-primary mr-1"><i class="fas fa-file"></i></span>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <a href="{{ $v->url }}" target="_blank"><span class="badge badge-primary">Lihat <i class="fas fa-eye"></i></span></a>
                                                                        </td>
                                                                    </tr>
                                                                    @empty
                                                                    <tr>
                                                                        <td>

                                                                        </td>
                                                                        <td></td>
                                                                        <td class="text-center">

                                                                        </td>
                                                                        <td class="text-center">

                                                                        </td>
                                                                    </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-4 col-sm-12 mb-2">
                    <div id="sidebar-post">
                        @include('client.widget.list-icon', ['title'=>'TERPOPULER','data'=>$popular, 'limit'=>4])
                        @include('client.widget.list', ['title'=>'INFORMASI PENTING','data'=>$files, 'limit'=>4])
                        @include('client.widget.slide-small', ['title'=>'INFOGRAFIS', 'data'=>$infografis, 'limit'=>4])
                        <hr>
                        @include('client.widget.slide-podcast', ['title'=>'VIDEO & PODCAST', 'data'=> $video, 'limit'=>4])
                    </div>
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


