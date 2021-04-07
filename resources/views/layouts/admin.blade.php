<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Hotel Management</title>

        <link rel="shortcut icon" type="image/png" href="{{asset('img/logo.png')}}" />
        
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        @stack('css')
        
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
      <div class="wrapper" id="app">
        @include('inc.admin.navbar')
        
        @include('inc.admin.sidebar')
        
        @yield('content')

        @include('inc.admin.footer')
        @include('inc.logout-modal')
       
      <!-- REQUIRED SCRIPTS -->
      <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
      <script src="{{asset('js/adminlte.min.js')}}"></script>

      <script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
      <script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
      <script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
      <script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
      {{-- <script src="{{asset('js/admin.js')}}"></script> --}}
      
      @stack('js')      
    </body>
</html>