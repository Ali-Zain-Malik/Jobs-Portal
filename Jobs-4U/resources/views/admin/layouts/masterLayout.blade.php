<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Google fonts --}}
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    {{-- CSS files --}}
    <link href="{{ asset("admin_assets/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("admin_assets/vendor/bootstrap-icons/bootstrap-icons.css") }}" rel="stylesheet">
    <link href="{{ asset("admin_assets/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
    <link href="{{ asset("admin_assets/vendor/quill/quill.snow.css") }}" rel="stylesheet">
    <link href="{{ asset("admin_assets/vendor/quill/quill.bubble.css") }}" rel="stylesheet">
    <link href="{{ asset("admin_assets/vendor/remixicon/remixicon.css")}}" rel="stylesheet">
    <link href="{{ asset("admin_assets/vendor/simple-datatables/style.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("admin_assets/css/style.css") }}">

    {{-- Conditional style files depending upon the active page --}}
    @stack('styles')

    <title> @yield('title') </title>
</head>
<body>
    @include("admin.includes.header")
    @include("admin.includes.sidebar")
    
    @yield('main')

    {{-- Jquery --}}
    <script src="{{asset("js/jquery.js")}}"></script>


    <script src="{{  asset("admin_assets/vendor/apexcharts/apexcharts.min.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/chart.js/chart.umd.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/echarts/echarts.min.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/quill/quill.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/simple-datatables/simple-datatables.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/tinymce/tinymce.min.js")}}"></script>
    <script src="{{  asset("admin_assets/vendor/php-email-form/validate.js")}}"></script>

    <script src="{{ asset("admin_assets/js/main.js") }}"></script>

    {{-- Conditional script files depending upon active page. --}}
    @stack("scripts")
</body>
</html>