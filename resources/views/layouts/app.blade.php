<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Sigma Ultrimagem</title>
    @include('layouts.partials.head')
    @include('layouts.partials.script')
</head>

<body class="font-sans antialiased">

<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.partials.navigation')
    <!-- Page Heading -->
    @if (isset($header))
        <header class="pt-14 sm:ml-14">
            <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{$header}}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="sm:ml-14">
        {{ $slot }}
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

    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    ;
</script>
