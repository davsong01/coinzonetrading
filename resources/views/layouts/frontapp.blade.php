<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('front-end/images/favicon.png')}}">

    <title>{{ env('APP_NAME') }}</title>
    
	<!-- Vendors Style-->
	{{-- <link rel="stylesheet" href="{{ url('front-end/css/vendors_css.css') }}"> --}}
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/OwlCarousel2/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/OwlCarousel2/dist/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/Magnific-Popup-master/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/lightbox-master/dist/ekko-lightbox.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/bootstrap-select/dist/css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/fullcalendar/fullcalendar.min.css')}}">
   
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/aos/aos.css')}}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/datatable/datatables.min.css')}}">

    <link rel="stylesheet" href="{{ url('front-end/corenav-master/coreNavigation-1.1.3.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/corenav-master/coreNavigation-1.1.3.css') }}">
    <link rel="stylesheet" href="{{ url('front-end/assets/vendor_components/fullcalendar/fullcalendar.print.min.css') }}">
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('front-end/css/skin_color.css') }}">
    <style>
        .homeScreenshot--mmo {
            background: transparent url("{{ asset('front-end/images/banners/homePreview-MMO.png') }}") no-repeat center top;
            background-size: cover;
        }
        .homeScreenshot--gcs {
            background: transparent url("{{ asset('front-end/images/banners/homePreview-MMO2.png')}}") no-repeat center top;
            background-size: cover;
        }
        .packages{
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5) !important;
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
