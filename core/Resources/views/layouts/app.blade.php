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

        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-red.min.css')}}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        @stack('css')
    </head>
    <body class="hold-transition skin-red sidebar-mini">
        <div class="wrapper">
            @include('partials.header')
        
            @include('partials.sidebar')

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                @include('partials.breadcrumb')

                <section class="content">
                    @if (session('splash-message'))
                        <div class="alert alert-{{ session('splash-type') }}" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ (session('splash-type') == 'error') ? 'Oops' : 'Heads up!' }}</strong><br/>
                            {{ session('splash-message') }}
                        </div>
                    @endif
                    
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Laravel version</b> {{ app()::VERSION }}
                </div>
                <strong>Copyright &copy; 2019 <a href="https://fanintek.com">FAN Integrasi Teknologi PT</a>.</strong> 
                All rights reserved.
            </footer>

        </div>

        <!-- jQuery 3 -->
        <script src="{{ asset('assets/vendor/jquery/js/jquery.min.js') }}"></script>
        
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        
        <!-- SlimScroll -->
        <script src="{{ asset('assets/vendor/jquery-slimscroll/js/jquery.slimscroll.min.js') }}"></script>
        
        <!-- FastClick -->
        <script src="{{ asset('assets/vendor/fastclick/js/fastclick.js') }}"></script>

        <!-- AdminLTE App -->
        <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
        

        @stack('js')

        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            })
        </script>
    </body>
</html>
