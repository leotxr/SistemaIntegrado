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
