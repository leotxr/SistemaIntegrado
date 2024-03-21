<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('recepcao::layouts.partials.head')

    @include('recepcao::layouts.partials.script')
</head>

<body class="font-sans antialiased">
@livewire('layouts.navigation', ['name' => 'Recepção'])
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <header class="bg-white shadow dark:bg-gray-800">
        <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main class="p-4">
        @yield('content')
    </main>
</div>

</body>

</html>
<script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
