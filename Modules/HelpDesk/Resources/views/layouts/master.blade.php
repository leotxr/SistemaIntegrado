<!DOCTYPE html>
<html lang="en">

<head>
    @include('helpdesk::layouts.partials.head')
</head>

<body>
    <main class="main">
        @include('helpdesk::layouts.partials.components.alerts')
        @include('helpdesk::layouts.partials.navigation')
        @yield('content')
    </main>
    @include('helpdesk::layouts.partials.script')
</body>

</html>