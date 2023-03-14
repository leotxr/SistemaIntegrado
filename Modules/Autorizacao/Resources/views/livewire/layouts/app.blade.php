<!doctype html>
<html data-theme="cupcake">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('datatables/datatables.css') }}">

    <title>{{ config('app.name', 'Autorização') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<livewire:autorizacao::navigation.nav />

<body class="font-sans antialiased">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.182 16.318A4.486 4.486 0 0012.016 15a4.486 4.486 0 00-3.198 1.318M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                    </svg>
                    <span>{{ $error }}</span>
                </div>
            </div>
        @endforeach
    @endif
    <!-- SUCESSO -->
    @if (\Session::has('success'))
        <div class="alert alert-success shadow-lg">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                </svg>
                <span>{!! \Session::get('success') !!}</span>
            </div>
        </div>
    @endif

    @if (auth()->user())
        @livewireScripts



        <div class="p-5">
            @include('autorizacao::livewire.layouts.floating-action-button')
            <div
                class="loader-wrapper bg-base-200 absolute w-full h-full grid place-items-center top-0 left-0 opacity-90">
                <span class="loader"></span>
            </div>
        @else
            <script>
                window.location.href = "{{ url('/') }}"
            </script>
    @endif

</body>
<script>
    $(window).on("load", function() {
        $(".loader-wrapper").fadeOut("slow");
    });
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
