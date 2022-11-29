<!doctype html>
<html lang="en" class="line-numbers">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="/js/app.js"></script>
        @yield('includes')
        <link href="/css/app.css" rel="stylesheet">
        <title>TRF4\UI Docs</title>
    </head>
    <body>
        @yield('body-content')
    </body>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</html>
