<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    @yield('head')
</head>

<body>
<div id="app">
    @yield('content')
</div>


<script src="{{ mix('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>