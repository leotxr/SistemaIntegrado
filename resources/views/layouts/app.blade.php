<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="manifest" href="/manifest.json">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="PWA">

    <title>{{ config('app.name', 'sigma') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>


</head>

<body class="font-sans antialiased">
    @if (auth()->user()->can('admin'))
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @include('components.floating-action-button')
                {{ $slot }}
                <div class="absolute top-0 grid w-screen h-screen loader-wrapper bg-base-200 place-items-center opacity-90">
                    <span class="loader"></span>
                </div>
            </main>
        </div>
    @else
        <script>
            window.location.href = "{{ url('welcome') }}"
        </script>
    @endif

</body>

</html>

<script>
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut("slow");
    });
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
