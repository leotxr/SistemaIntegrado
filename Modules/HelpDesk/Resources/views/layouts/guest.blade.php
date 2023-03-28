<!DOCTYPE html>
<html lang="en">

<head>
    @include('helpdesk::layouts.partials.head')
</head>

<body>
   @include('helpdesk::layouts.guest.guest-navigation')
    <main class="main">
        @yield('content')
    </main>
    @include('helpdesk::layouts.partials.script')
</body>

</html>