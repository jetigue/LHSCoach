<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Longhorn Coach') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/main.js') }}" defer></script>

        <!-- Fonts -->
        <script src="https://kit.fontawesome.com/475d4da242.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
<body>
    <div id="app" class="w-full min-h-screen bg-gray-white">
         @if (Route::has('welcome'))
                <x-welcome-layout></x-welcome-layout>
        @else
        <div class="flex flex-col w-full">
            <x-banner>
                <header class="text-white text-3xl md:text-4xl">
                    <a href="/">Longhorn Coach</a>
                </header>
            </x-banner>
        </div>
        <div class="flex min-h-screen lg:w-2/3 mx-auto" id="main">
            {{ $slot }}
        </div>
        @endif
        <portal-target name="create-modal"></portal-target>
    </div>
</body>

</html>
