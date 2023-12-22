<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('nc::layouts.partials.head')
    @include('nc::layouts.partials.script')
</head>


<body class="font-sans antialiased" x-data="{expanded: false}">
@livewire('nc::layout.navigation')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <header class="pt-14" :class="expanded ? 'sm:ml-64' : 'sm:ml-14'">
        <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main class="" :class="expanded ? 'sm:ml-64' : 'sm:ml-14'">
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
/*
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }

 */

</script>

