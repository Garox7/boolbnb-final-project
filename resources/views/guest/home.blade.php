<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Boolpress') }}</title>

    {{-- style TomTom --}}
    <link
      rel="stylesheet"
      type="text/css"
      href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.7.0/maps/maps.css"
    />

    {{-- JavaScript --}}
    <script src="{{ asset('js/front.js') }}" defer></script>
</head>
<body>
    <div id="app"></div>
    <script>
        window.user = @json(auth()->check());
    </script>
</body>
</html>
