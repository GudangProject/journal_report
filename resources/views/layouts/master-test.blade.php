<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie ie9" lang="en-US">
   <![endif]-->
<html lang="en-US">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- Title-->
	<title>Kantor Kementerian Agama {{ $data->title }}</title>

    <meta name="description" content="Kantor Kementerian Agama {{ $data->title }}" />
	<meta name="keywords" content="Kantor Kementerian Agama {{ $data->title }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="author" content="" />
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Kantor Kementerian Agama {{ $data->title }}" />
    <meta property="og:description" content="Kantor Kementerian Agama {{ $data->title }}" />
    <meta property="og:image" content="{{ $data->images['medium'] ?? asset('/assets/images/logo.png') }}" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="450">
    <meta property="og:site_name" content="{{ request()->url() }}" >

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@kemenagsulsel">
    <meta name="twitter:creator" content="@kemenagsulsel">
    <meta name="twitter:description" content="Kantor Kementerian Agama {{ $data->title }}" />
    <meta name="twitter:image" content="{{ $data->images['medium'] ?? asset('/assets/images/logo.png') }}" />
    <meta name="twitter:image:src" content="{{ $data->images['medium'] ?? asset('/assets/images/logo.png') }}" />
    <meta name="twitter:title" content="Kantor Kementerian Agama {{ $data->title }}" />

	<!-- Favicon-->
	<link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon" />
	<!-- Stylesheets-->
	<link rel="stylesheet" href="{{ asset('test/css/bootstrap.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('test/css/shop.css') }}" type="text/css" media="all" />

    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('assets/css/main.css')}} " type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}" type="text/css" media="all">
	<!-- end head -->
</head>

<body class="single single-product woocommerce woocommerce-page woocommerce-js mobile_nav_class jl-has-sidebar">
	<div class="options_layout_wrapper jl_clear_at jl_radius jl_none_box_styles jl_border_radiuss jl_en_day_night">
		<div class="options_layout_container full_layout_enable_front">

            @include('client.navigation.header')

			<div class="mobile_menu_overlay"></div>
			@yield('content')

			@include('client.navigation.footer')
			<div id="go-top"> <a href="#go-top"><i class="jli-up-chevron"></i></a>
			</div>
		</div>
	</div>
	<script src="{{ asset('test/js/jquery.js') }}"></script>
	<script src="{{ asset('test/js/fluidvids.js') }}"></script>
	<script src="{{ asset('test/js/slick.js') }}"></script>
	<script src="{{ asset('test/js/custom.js') }}"></script>
</body>

</html>
