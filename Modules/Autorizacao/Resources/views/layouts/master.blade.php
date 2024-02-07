<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('autorizacao::layouts.partials.head')

    @include('autorizacao::layouts.partials.script')
</head>

<body class="font-sans antialiased">
@include('autorizacao::layouts.partials.alerts')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    {{-- @include('autorizacao::layouts.partials.navigation') --}}
    @livewire('layouts.navigation', ['name' => 'Autorização'])
    @include('autorizacao::layouts.partials.sidebar')
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

    window.addEventListener('protocol-in-use', event => {
        toastr[event.detail.type](event.detail.message ?? 'Este protocolo está sendo utilizado pelo usuário ' + event.detail.user,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });

    window.addEventListener('notify', event => {
        toastr[event.detail.type](event.detail.message ?? '',
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });

    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);

    @if (Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
        case 'info':

            toastr.options.timeOut = 10000;
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':

            toastr.options.timeOut = 10000;
            toastr.success("{{ Session::get('message') }}");

            break;
        case 'warning':

            toastr.options.timeOut = 10000;
            toastr.warning("{{ Session::get('message') }}");

            break;
        case 'error':

            toastr.options.timeOut = 10000;
            toastr.error("{{ Session::get('message') }}");

            break;
    }
    @endif

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }

</script>
