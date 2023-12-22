<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Sigma Ultrimagem</title>
    @include('layouts.partials.head')
    @include('layouts.partials.script')
</head>

<body class="font-sans antialiased">

<div class="min-h-screen bg-gray-900">
    <!-- Page Content -->
    <main class="p-5">
        {{ $slot }}
    </main>
</div>

</body>
</html>
