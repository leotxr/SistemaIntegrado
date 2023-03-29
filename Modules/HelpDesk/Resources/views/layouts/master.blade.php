<!DOCTYPE html>
<html lang="en">

<head>
    @include('helpdesk::layouts.partials.head')
</head>

<body>
    @if (\Session::has('success'))
    <x-helpdesk::alert message="{!! \Session::get('success') !!}" title="Sucesso!"> </x-helpdesk::alert>
    @endif
    <main class="main">
        @include('helpdesk::layouts.partials.navigation')
        @yield('content')
    </main>
    @include('helpdesk::layouts.partials.script')
</body>

</html>
