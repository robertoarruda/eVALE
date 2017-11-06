<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

        <!-- Scripts -->
        <script>
            window.Laravel = { csrfToken: '{{ csrf_token() }}' };
        </script>

    </head>
    <body class="{{ $bdstyle ?? '' }}">
        @yield('body')

        <script src="{{ asset("js/app.js") }}"></script>
        <script src="{{ asset("js/admin.js") }}"></script>
    </body>
</html>