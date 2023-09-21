<!DOCTYPE html>
<html lang="en">

<head>
    @include('orcamento::layouts.partials.head')
    @include('orcamento::layouts.partials.script')
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('orcamento::layouts.partials.navigation')
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