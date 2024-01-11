<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('triagem::layouts.partials.head')

    @include('triagem::layouts.partials.script')
</head>

<body class="font-sans antialiased">
@include('triagem::layouts.partials.alerts')
@include('triagem::layouts.partials.navigation')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <header class="bg-white shadow dark:bg-gray-800 relative z-30 top-14 w-full" >
        <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @yield('header')
        </div>
    </header>
    <main class="pt-14">
        @yield('content')
    </main>
</div>

</body>

</html>

<script>
    $(window).on("load", function () {
        $(".loader-wrapper").fadeOut("slow");
    });
    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
