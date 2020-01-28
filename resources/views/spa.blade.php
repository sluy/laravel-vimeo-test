<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue SPA Demo</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <app></app>
    </div>
    <script>
        window._translations = {!! cache('translations') !!};
        console.log(_translations);
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
