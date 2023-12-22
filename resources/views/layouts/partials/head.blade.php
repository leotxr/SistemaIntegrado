<link rel="manifest" href="/manifest.json">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="PWA">

<title>{{ config('app.name', 'sigma') }}</title>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
<livewire:styles />
<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
