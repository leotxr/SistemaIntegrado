<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:administrativo::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Módulo Administrativo') }}
        </h2>
    </div>

    <div class="p-2">
        <div class="overflow-x-auto">
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tempo Extra</th>
                        <th>Funcionário</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <td>{{ $user->tempo }}</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
