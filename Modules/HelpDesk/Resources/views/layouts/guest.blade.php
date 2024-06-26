<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('helpdesk::layouts.partials.head')

    @include('helpdesk::layouts.partials.script')
</head>

<body class="font-sans antialiased">
@include('helpdesk::layouts.partials.alerts')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 text-sm">
    @include('helpdesk::layouts.partials.guest_navigation')
    <header class="pt-14 sm:ml-14">
        <div class="px-4 py-4 mx-auto max-w-full sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main class="sm:ml-14">
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
