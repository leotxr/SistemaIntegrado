<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('helpdesk::layouts.partials.head')

    @include('helpdesk::layouts.partials.script')
</head>

<body class="font-sans antialiased">
    @include('helpdesk::layouts.partials.alerts')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('helpdesk::layouts.partials.navigation')
        <header class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
        <main class="p-8 sm:ml-64">
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
</script>