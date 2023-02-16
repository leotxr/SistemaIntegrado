<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:triagem::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Módulo Triagem') }}
        </h2>
    </div>

    <div class="p-5 shadow-md rounded-md bg-white text-center justify-items-center">
        <div class="max-w-sm bg-white shadow-md rounded-md">
            {{$tipoexame}}
            {{$start}}
        </div>
    </div>

</body>
