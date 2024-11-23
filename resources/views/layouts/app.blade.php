<!DOCTYPE html>
<html lang="en">
<head>
    
    @stack('styles')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Contenido principal -->
        <!-- @yield('content') -->
    </div>

    <!-- Scripts principales de AdminLTE -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

    
    @stack('scripts')

</body>
</html>
