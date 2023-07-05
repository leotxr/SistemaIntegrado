<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @include('autorizacao::layouts.partials.head')

    @include('autorizacao::layouts.partials.script')
</head>

<body class="font-sans antialiased">
    @include('autorizacao::layouts.partials.alerts')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('autorizacao::layouts.partials.navigation')
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
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut("slow");
    });
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
    
</script>
