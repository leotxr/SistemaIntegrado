<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:administrativo::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Horas Extras') }}
        </h2>
    </div>

    <div class="p-2">
        <div class="p-2">
            <a type="button" href="{{url('extratimes/create')}}"class="btn btn-info">Novo</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Data</th>
                        <th>Tempo Extra</th>
                        <th>Funcionário</th>
                        <th>Motivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($extratimes as $et)
                        @php
                            $user = $et->find($et->id)->relUsers;
                            $motivo = $et->find($et->id)->relReasons;
                        @endphp
                        <tr>
                            <th>1</th>
                            <td>{{ $et->data }}</td>
                            <td>{{ $et->tempo }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $motivo->name }}</td>
                            <td><a href="{{ url("extratimes/$et->id/edit") }}" type="button" class="btn btn-secondary">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
