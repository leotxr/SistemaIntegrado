<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('triagem::layouts.partials.head')

    @include('triagem::layouts.partials.script')
</head>

<body class="font-sans antialiased">
    @include('triagem::layouts.partials.alerts')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('triagem::layouts.partials.navigation')
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            </div>
        </header>
        <main>
            @yield('content')
        </main>
    </div>

</body>

</html>

<script>
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut("slow");
    });
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
