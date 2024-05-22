<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title data-app="{{ env('APP_NAME') }}">{{ env('APP_NAME') }}</title>
    </head>
    <body class="bg-light w-100">
        <div id="app"></div>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>