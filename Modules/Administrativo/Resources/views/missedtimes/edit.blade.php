<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:administrativo::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Editar Horas Faltosas') }}
        </h2>
    </div>

    <div class="text-center justify-items-center py-2 rounded-sm shadow-sm">
        <form action="/missedtimes/{{$missedtime->id}}')" method="PUT">
            @csrf
            <div>
                <label class="label">
                    Funcionário
                </label>
                <select name="user_id" class="select select-bordered w-full max-w-xs">
                        <option value="{{$users->id}}">{{ $users->name }}</option>
                </select>
            </div>


            <div>
                <label class="label">
                    Data
                </label>
                <input type="date" placeholder="data" name="data" value="{{$missedtime->data}}" class="input input-bordered w-full max-w-xs" />
            </div>

            <div>
                <label class="label">
                    Tempo Falta
                </label>
                <input type="time" placeholder="Tempo" name="tempo" value="{{$missedtime->tempo}}" class="input input-bordered w-full max-w-xs" />
            </div>

            <div>
                <label class="label">
                    Motivo
                </label>
                <select name="motivo" class="select select-bordered w-full max-w-xs">
                        <option value="{{$reasons->id}}">{{ $reasons->name }}</option>
                </select>
            </div>

            <div>
                <label class="label">
                    Justificativa
                </label>
                <input type="text" placeholder="Justificativa" value="{{$missedtime->justificativa}}" name="justificativa"
                    class="input input-bordered w-full max-w-xs" />
                    
            </div>

            <div>
                <label class="label">
                    Observação
                </label>
                <textarea class="textarea text-area-md textarea-primary" value="{{$missedtime->observacao}}" name="observacao" placeholder="Observação">{{$missedtime->observacao}}</textarea>
            </div>

            <div class="p-5">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

</body>
