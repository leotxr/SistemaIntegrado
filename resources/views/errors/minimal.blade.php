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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">
<section>
    <div class="relative flex min-h-screen justify-center  items-top sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="px-4 text-lg tracking-wider text-gray-500 border-gray-400 flex justify-center">
                @yield('icon')
            </div>
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">

                <div class="px-4 text-lg tracking-wider text-gray-500 border-r border-gray-400">
                    @yield('code')
                </div>

                <div class="ml-4 text-lg tracking-wider text-gray-500 uppercase">
                    @yield('message')
                </div>
            </div>
            <div class="my-4 text-center" x-data>
                <a x-on:click="history.back()">
                    <x-secondary-button>Voltar à pagina anterior</x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</section>
</body>
</html>
<script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>

