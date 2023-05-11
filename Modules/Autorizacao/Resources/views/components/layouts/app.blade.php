<!DOCTYPE html>
<html lang="pt-br">

<head>
    @include('autorizacao::components.layouts.partials.head')

</head>

<body>
    @include('autorizacao::components.layouts.partials.navigation')

    <main class="p-4 ">
        {{$slot}}
    </main>

    @include('autorizacao::components.layouts.partials.script')
</body>

</html>