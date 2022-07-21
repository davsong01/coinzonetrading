<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('front-end/images/favicon.ico')}}">

    <title>{{ env('APP_NAME') }}</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('front-end/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('front-end/css/skin_color.css') }}">
    <style>
        .homeScreenshot--mmo {
            background: transparent url("{{ asset('front-end/images/front-end-img/homePreview-MMO.png') }}") no-repeat center top;
            background-size: cover;
        }
        .homeScreenshot--gcs {
            background: transparent url("{{ asset('front-end/images/front-end-img/homePreview-MMO2.png')}}") no-repeat center top;
            background-size: cover;
        }
     </style>
  </head>

<body class="theme-warning">
	{{-- Header start --}}
	@include('layouts.header')
	{{-- Header end --}}
    
    @yield('body')
	
	{{-- Footer start --}}
	@include('layouts.footer')
	{{-- footer end --}}
</body>
</html>
