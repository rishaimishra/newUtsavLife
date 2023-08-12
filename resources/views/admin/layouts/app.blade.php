<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <title>{{ config('app.name', 'Laravel') }} :: Admin</title> --}}
        @yield('title')
        @yield('style')
        <!-- Scripts -->
        {{--  <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <style>
            .ck-editor__editable {
                min-height: 300px;
            }
        </style>
        <!-- Styles -->
        {{--  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        @yield('head')
    </head>
    <body>


        <div id="wrapper">
            @yield('left_part')
            @yield('content')
        </div>
        <div class="wrapper-page">
            @yield('header')
            @yield('body')
            @yield('errors')
            @yield('footer')
        </div>
        @yield('script')
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</body>
</html>
