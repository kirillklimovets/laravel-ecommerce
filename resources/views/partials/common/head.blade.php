<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('icon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ config('app.name', 'Laravel E-Commerce') }}
    </title>

    @yield('pageHeadExtensions')
</head>
<body class="d-flex flex-column min-vh-100">
