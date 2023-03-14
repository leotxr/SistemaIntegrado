<!DOCTYPE html>
<html lang="en">

<head>
   @include('triagem::layouts.partials.head')

    {{-- Laravel Vite - CSS File --}}
    {{--{{ module_vite('build-triagem', 'Resources/assets/sass/app.scss') }}--}}

</head>

<body>
    @include('triagem::layouts.partials.navigation')
    @include('triagem::layouts.partials.alerts')
    <main class="main">
        @yield('content')
    </main>

    @include('triagem::layouts.partials.script')
    {{-- Laravel Vite - JS File --}}
    {{--{{ module_vite('build-triagem', 'Resources/assets/js/app.js') }}--}}

</body>

</html>
