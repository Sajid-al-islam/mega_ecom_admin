<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="etek" />
    <title>ETEK</title>

    <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('backend/assets/css/pace.min.css') }}" rel="stylesheet" />

    <script src="{{ asset('backend/assets/js/pace.min.js') }}"></script>

    <link href="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/boxicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/app-style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="/backend/assets/css/custom/custom.css">

    {{-- <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> --}}

    <script src="/plugins/sweet_alert.js" defer></script>
    <script src="/backend/assets/js/jquery.min.js"></script>
</head>

<body class="bg-theme bg-theme9" id="body">
    <div id="app">
        <app></app>
    </div>

    <style>
        .cke_notifications_area {
            display: none !important;
        }
    </style>
    <script src="/backend/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="/backend/assets/plugins/Chart.js/Chart.min.js"></script>
    <script src="/backend/assets/plugins/peity/jquery.peity.min.js"></script>
    @vite(['resources/js/backend/app.js'])
</body>

</html>
