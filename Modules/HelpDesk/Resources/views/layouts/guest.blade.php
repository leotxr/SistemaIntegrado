<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('helpdesk::layouts.partials.head')

    @include('helpdesk::layouts.partials.script')
</head>

<body class="font-sans antialiased">
@include('helpdesk::layouts.partials.alerts')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @livewire('layouts.navigation', ['name' => 'HelpDesk'])
    @can(['editar chamado', 'excluir chamado'])
        @include('helpdesk::layouts.partials.sidebar')
    @endcan
    <header class="bg-white shadow dark:bg-gray-800">
        <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main>
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
    ;
</script>
