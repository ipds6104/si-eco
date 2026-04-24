<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CAIKUE') }}</title>
    <link rel="icon" href="{{ asset('/assets/img/logo.webp') }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('assets/css/fonts.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/login/style.css') }}">
</head>

<body>
    {{ $slot }}
    <script src="{{ asset('assets/login/script.js') }}"></script>
</body>

</html>
