
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ website()->name }}</title>

    <link rel="apple-touch-icon" href="{{asset('assets/images/data.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/data.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    @livewireStyles

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

    @php
        $web = \App\Models\Websetting::orderBy('created_at')->first();
    @endphp
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            @if (isset($web->logo))
                <img src="{{ asset('storage') }}/assets/{{ $web->logo }}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0 bg-secondary" height="80" width="250" alt="Logo" />
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item mr-2 mt-1 active">
                    @if (auth()->user())
                        <a href="/admin" class="font-weight-bold"><i data-feather="grid"></i> DASHBOARD</a>
                    @else
                        <a href="{{ route('login') }}" class="font-weight-bold"><i data-feather="log-in"></i> LOGIN</a>
                    @endif
                </li>
                <li class="nav-item mr-2 mt-1">
                    <a href="{{ route('register') }}" class="font-weight-bold"><i data-feather="user-plus"></i> REGISTER</a>
                </li>
                <li class="nav-item mr-2 mt-1">
                    <a href="/panduan-author" class="font-weight-bold" target="_blank"><i data-feather="book-open"></i> PANDUAN</a>
                <li class="nav-item mr-2 mt-1">
                    <a href="/legalitas" class="font-weight-bold" target="_blank"><i data-feather="file-text"></i> LEGALITAS</a>
        </div>
    </nav>
    {{-- <nav class="header-navbar navbar navbar-expand-lg align-items-center justify-content-center floating-nav navbar-sm-light">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav bookmark-icons">

                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item mr-2">
                    <div class="btn-group">
                        @if (auth()->user())
                            <a href="/admin" class="btn btn-success"><i data-feather="grid"></i> DASHBOARD</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary"><i data-feather="log-in"></i> LOGIN</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary"><i data-feather="user-plus"></i> REGISTER</a>
                            <a href="/panduan-author" class="btn btn-warning" target="_blank"><i data-feather="book-open"></i> PANDUAN</a>
                            <a href="/legalitas" class="btn btn-success" target="_blank"><i data-feather="file-text"></i> LEGALITAS</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav> --}}

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ $data->count() }}</h2>
                                <p class="card-text">Total Jurnal</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="book" class="font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ $data->sum('total') }}</h2>
                                <p class="card-text">Slot yang tersedia</p>
                            </div>
                            <div class="avatar bg-light-success p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="activity" class="font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h2 class="font-weight-bolder mb-0">{{ $naskah->count() }}</h2>
                                <p class="card-text">Slot yang sudah terisi</p>
                            </div>
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="activity" class="font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @if (session()->has('message'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <div class="alert-body"><strong>{{ session('message') }}</strong></div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @livewire('journals.stock-public')
            </div>
        </div>
    </div>



    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <div class="d-flex justify-content-center">
            <span>
                <table class="visitor">
                    <tr>
                        <td colspan="3" class="title">TOTAL PENGUNJUNG<i data-feather='trending-up'></i></td>
                    </tr>
                    <tr>
                        <td class="day">Hari ini  {{ $visitor[0]['day'] }} </td>
                        <td class="week">Minggu ini  {{ $visitor[0]['week'] }}</td>
                        <td class="month">Bulan ini  {{ $visitor[0]['month'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="year">Tahun ini {{ $visitor[0]['year'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="total">Total {{ $visitor[0]['total'] }}</td>
                    </tr>
                </table>
            </span>
        </div>
        <p class="clearfix mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">
                COPYRIGHT &copy; 2023 {{ config('app.name') }}
                <span class="d-none d-sm-inline-block">, All rights Reserved</span>
            </span>
            <span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets') }}/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('app-assets') }}/vendors/js/charts/apexcharts.min.js"></script> --}}
    <script src="{{ asset('app-assets') }}/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets') }}/js/core/app-menu.js"></script>
    <script src="{{ asset('app-assets') }}/js/core/app.js"></script>
    <!-- END: Theme JS-->

    @livewireScripts
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            Livewire.hook('message.processed', (message, component) => {
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
                })
            })
        });
        window.addEventListener('openModalDetail', event => {
            $("#detail-modal").modal('show');
        });

        window.addEventListener('openModalStatus', event => {
            $("#status-modal").modal('show');
        });

        window.addEventListener('closeModalStatus', event => {
            $("#status-modal").modal('hide');
        });

        window.addEventListener('openModalDelete', event => {
            $("#delete-modal").modal('show');
        });

        window.addEventListener('closeModalDelete', event => {
            $("#delete-modal").modal('hide');
        });
    </script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
