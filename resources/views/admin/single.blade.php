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
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}" />
    @yield('stylesheets')
</head>
<body class="hold-transition login-page">
    <div class="wrapper">

        @yield('content')
    </div>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
    @yield('scripts')
</body>
</html>