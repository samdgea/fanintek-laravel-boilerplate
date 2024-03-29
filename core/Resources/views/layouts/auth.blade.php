<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title : 'Default Page' }} | {{ config('app.name', 'Laravel') }}</title>
        
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">

        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/Ionicons/css/ionicons.min.css') }}">
        
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/css/AdminLTE.min.css') }}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        @stack('css')
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>FAN</b>Intek</a>
            </div>
            <!-- /.login-logo -->

            @yield('content')
            
        </div>
        <!-- /.login-box -->

        <!-- jQuery 3 -->
        <script src="{{ asset('assets/vendor/jquery/js/jquery.min.js') }}"></script>
        
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        
        @stack('js')

    </body>
</html>