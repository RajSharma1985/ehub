<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" />
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" />
    @yield('stylesheets')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin.partials.header')
        @include('admin.partials.sidebar')
        @yield('content')
        @include('admin.partials.footer')

    </div>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    @yield('scripts')
</body>
</html>