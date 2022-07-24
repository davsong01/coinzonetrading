<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="../images/favicon.ico">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Bootstrap 4.0-->
        <link rel="stylesheet" href="{{ asset('back-end/assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}">

        <!--amcharts -->
        <link href="https://www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap-extend -->
        <link rel="stylesheet" href="{{ asset('back-end/css/bootstrap-extend.css') }}">

        <!-- theme style -->
        <link rel="stylesheet" href="{{ asset('back-end/css/master_style.css') }}">

        <!-- Crypto_Admin skins -->
        <link rel="stylesheet" href="{{ asset('back-end/css/skins/_all-skins.css')}}">


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    </head>
    <body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        @include('layouts.app-header')
        @include('layouts.app-sidebar')
            <main>
                {{ $slot }}
            </main>
        @include('layouts.app-footer')
        </div>

        	<!-- jQuery 3 -->
	<script src="{{ asset('back-end/assets/vendor_components/jquery/dist/jquery.js') }}"></script>

	<!-- popper -->
	<script src="{{ asset('back-end/assets/vendor_components/popper/dist/popper.min.js') }}"></script>

	<!-- Bootstrap 4.0-->
	<script src="{{ asset('back-end/assets/vendor_components/bootstrap/dist/js/bootstrap.js') }}"></script>

	<!-- Slimscroll -->
	<script src="{{ asset('back-end/assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

	<!-- FastClick -->
	<script src="{{ asset('back-end/assets/vendor_components/fastclick/lib/fastclick.js') }}"></script>

    <!--amcharts charts -->
	<script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/gauge.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/amstock.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/pie.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/plugins/animate/animate.min.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/plugins/export/export.min.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/themes/patterns.js" type="text/javascript"></script>
	<script src="http://www.amcharts.com/lib/3/themes/light.js" type="text/javascript"></script>

	<!-- webticker -->
	<script src="{{ asset('back-end/assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js') }}"></script>

	<!-- EChartJS JavaScript -->
	<script src="{{ asset('back-end/assets/vendor_components/echarts-master/dist/echarts-en.min.js') }}"></script>
	<script src="{{ asset('back-end/assets/vendor_components/echarts-liquidfill-master/dist/echarts-liquidfill.min.js') }}"></script>

	<!-- This is data table -->
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>

	<!-- Crypto_Admin App -->
	<script src="{{ asset('back-end/js/template.js') }}"></script>

	<!-- Crypto_Admin dashboard demo (This is only for demo purposes) -->
	<script src="{{ asset('back-end/js/pages/dashboard.js') }}"></script>
	<script src="{{ asset('back-end/js/pages/dashboard-chart.js') }}"></script>

	<!-- Crypto_Admin for demo purposes -->
	<script src="{{ asset('js/demo.js') }}"></script>
    </body>
</html>
