<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="mobile-web-app-capable" content="yes">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- style="background-image: url('/storage/icons/fundo.jpg')" bg-cover bg-center bg-no-repeat -->

<body
    class="font-sans text-gray-800 antialiased  bg-[radial-gradient(ellipse_at_right,_var(--tw-gradient-stops))] from-sky-400 to-indigo-900">
    <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0 ">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </div>

        <div class="w-full px-6 py-4 mt-6 overflow-hidden shadow-md sm:max-w-md sm:rounded-lg glass">
            {{ $slot }}
        </div>
        <p class="text-xs text-white">Ultrimagem ®️  2023 | Desenvolvido por TIC Ultrimagem Ubá</p>
    </div>
</body>

</html>
