<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}">
        
        <title>Verizon Wireless Content Management System</title>

        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>

        @yield('content')

        <script src="{{ asset('js/main.js') }}"></script>

    </body>
</html>