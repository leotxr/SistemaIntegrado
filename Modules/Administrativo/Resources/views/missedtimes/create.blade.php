<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:administrativo::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Cadastrar Horas Faltosas') }}
        </h2>
    </div>

    <div class="text-center justify-items-center py-2 rounded-sm shadow-sm">
        <form action="{{ url('missedtimes') }}" method="POST">
            @csrf
            <div>
                <label class="label">
                    Funcionário
                </label>
                <select name="user_id" class="select select-bordered w-full max-w-xs">
                    <option disabled selected>Funcionário</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <label class="label">
                    Data
                </label>
                <input type="date" placeholder="data" name="data" class="input input-bordered w-full max-w-xs" />
            </div>

            <div>
                <label class="label">
                    Tempo Extra
                </label>
                <input type="time" placeholder="Tempo" name="tempo" class="input input-bordered w-full max-w-xs" />
            </div>

            <div>
                <label class="label">
                    Motivo
                </label>
                <select name="motivo" class="select select-bordered w-full max-w-xs">
                    <option disabled selected>Motivo</option>
                    @foreach ($reasons as $reason)
                        <option value="{{$reason->id}}">{{ $reason->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label">
                    Justificativa
                </label>
                <input type="text" placeholder="Justificativa" name="justificativa"
                    class="input input-bordered w-full max-w-xs" />
            </div>

            <div>
                <label class="label">
                    Observação
                </label>
                <textarea class="textarea text-area-md textarea-primary" name="observacao" placeholder="Observação"></textarea>
            </div>

            <div class="p-5">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

</body>
