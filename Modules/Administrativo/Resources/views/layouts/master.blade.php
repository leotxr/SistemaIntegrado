<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('administrativo::layouts.partials.head')

    @include('administrativo::layouts.partials.script')
</head>

<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    {{-- @include('autorizacao::layouts.partials.navigation') --}}
    @livewire('layouts.navigation', ['name' => 'Administrativo'])
    @include('administrativo::layouts.partials.sidebar')
    <header class="pt-14" :class="expanded ? 'sm:ml-64' : 'sm:ml-14'">
        <div class="px-4 pt-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main class="py-4">
        @yield('content')
    </main>
</div>

</body>

</html>

<script>

    window.addEventListener('notify', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }

</script>
