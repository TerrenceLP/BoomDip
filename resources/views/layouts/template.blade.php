<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" >
    <link href="{{ asset('css/bootstrap-social-gh-pages/bootstrap-social.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="app" class="wrapper">
        <!-- NavBar -->
        <navbar-component></navbar-component>
        <!-- SideBar -->
        <sidebar-component></sidebar-component>
        <!-- Content -->
        <div id="content">
            @yield('content')
        </div>
    </div>
    <div class="overlay"></div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.mCustomScrollbar.js') }}"></script>
    @yield('scripts')
</body>
</html>
