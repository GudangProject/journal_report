<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ env('APP_NAME') }}</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="{{asset('assets/images/favicon.png')}}">
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon.png')}}">
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


        <style>
            [x-cloak] { display: none !important; }
        </style>


        @stack('styles')

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('app-assets/vendors/js/popper/popper.min.js') }}"></script>
        <script src="{{ asset('app-assets/vendors/js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{asset('app-assets/vendors/js/jquery/jquery.min.js')}}"></script>


        @stack('head-scripts')
        @stack('style-components')
    </head>
    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
        {{-- @include('sweetalert::alert') --}}
        @include('admin.navigation.header')
        @include('admin.navigation.sidebar')

            {{ $slot }}

        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>

        @include('admin.navigation.footer')

        @stack('modals')
        <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
        <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
        <script src="{{asset('app-assets/js/core/app.js')}}"></script>

        @stack('scripts')
        <script>
            $(window).on('load', function() {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            });
        </script>

        @livewireScripts

        @stack('script-components')
    </body>
</html>
