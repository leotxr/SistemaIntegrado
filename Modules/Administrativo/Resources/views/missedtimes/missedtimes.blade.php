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
            <a type="button" href="{{url('missedtimes/create')}}"class="btn btn-info">Novo</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-compact w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Data</th>
                        <th>Tempo Faltoso</th>
                        <th>Funcionário</th>
                        <th>Motivo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($missedtimes as $mt)
                    @php
                    $user = $mt->find($mt->id)->relUsers;
                    $motivo = $mt->find($mt->id)->relReason;
                    @endphp
                    <tr>
                        <th>1</th>
                        <td>{{$mt->data}}</td>
                        <td>{{$mt->tempo}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$motivo->name}}</td>
                        <td>
                            <a href="{{ url("missedtimes/$mt->id/edit") }}" type="button" class="btn btn-secondary">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
