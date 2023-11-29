<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Module Gestao</title>

    {{-- Laravel Vite - CSS File --}}
    {{ module_vite('build-gestao', 'Resources/assets/css/app.css') }}


    <livewire:styles/>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <livewire:scripts/>
    {{-- Laravel Vite - JS File --}}
    {{ module_vite('build-gestao', 'Resources/assets/js/app.js') }}

</head>

<body class="font-sans antialiased" x-data="{expanded: false}">
<div class="fixed bottom-0 end-0 z-90 flex justify-between w-full p-2 border-b bg-red-500">
    <div class="flex items-center mx-auto">
    <span>
        Este módulo está em fase de desenvolvimento, alguns processos podem não funcionar corretamente.
    </span>
    </div>
</div>
@livewire('gestao::layout.navigation')
<header class="pt-14 sm:ml-14">
    <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        @yield('header')
    </div>
</header>
<main class="" :class="expanded ? 'sm:ml-64' : 'sm:ml-14'">
    @yield('content')
</main>


</body>
</html>
