<!doctype html>
<html data-theme="corporate">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('datatables/datatables.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('datatables/datatables.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>{{ config('app.name', 'Administrativo') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

        
</head>

<body class="font-sans antialiased">
    <!-- ERRO -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-error shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
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
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>{!! \Session::get('success') !!}</span>
            </div>
        </div>
    @endif

    @if (auth()->user())
        @livewireScripts
        <livewire:triagem::navigation.nav />
        <div class="p-5">
        @else
            <script>
                window.location.href = "{{ url('/') }}"
            </script>
    @endif
</body>

<script>
    setTimeout(function() {
        $('.alert').slideToggle();
    }, 5000);
</script>
