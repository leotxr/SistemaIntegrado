<!DOCTYPE html>
<html lang="en">

<head>
    @include('orcamento::layouts.partials.head')
    @include('orcamento::layouts.partials.script')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('orcamento::layouts.partials.navigation')
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>