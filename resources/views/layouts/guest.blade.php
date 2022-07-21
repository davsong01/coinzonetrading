<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../images/favicon.ico">

        <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('front-end/css/vendors_css.css') }}">

	<!-- Style-->
	<link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('front-end/css/skin_color.css') }}">

  </head>

<body class="theme-warning">

	<!--Page content -->
	{{ $slot }}
	<!-- Vendor JS -->
	<script src="{{ asset('front-end/js/vendors.min.js') }}"></script>
	<!-- Corenav Master JavaScript -->
  <script src="{{ asset('front-end/js/nav.js') }}"></script>
	<script src="{{ asset('front-end/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>

<!-- CryptoCurrency front end -->
	<script src="{{ asset('/front-end/js/template.js')}}"></script>


</body>
</html>
