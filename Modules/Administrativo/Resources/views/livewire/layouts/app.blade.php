<!doctype html>
<html data-theme="corporate">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="/DataTables/datatables.css">

    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>

    <title>{{ config('app.name', 'Administrativo') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<body class="font-sans antialiased">
    @if (auth()->user())
        @livewireScripts
        <livewire:administrativo::navigation.nav />
        <div class="p-5">
        @else
            <script>
                window.location.href = "{{ url('/') }}"
            </script>
    @endif

</body>
