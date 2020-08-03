<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LHS Coach') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/475d4da242.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex flex-col w-full min-h-screen bg-gray-800 text-white">
        @if (Route::has('login'))
            <div class="flex w-full justify-end p-4">
                <x-sign-in></x-sign-in>
            </div>

        @endif
        <div>
            {{ $slot }}
        </div>
    </div>
</body>

</html>
