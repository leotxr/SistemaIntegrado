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
            <form action="{{url('terms/create')}}" method="GET" id="forminicio">

                <div class="max-w-xs p-2">
                    <label for="patient_id" class="label font-bold">
                        ID do Paciente
                    </label>
                    <input type="number" name="patient_id" placeholder="ID do paciente"
                        class="input input-bordered w-xs max-w-xs" />
                </div>

                <div class="max-w-xs p-2">
                    <label for="patient_id" class="label font-bold">
                        Procedimento
                    </label>
                    <select name="procedure" class="select select-bordered w-full max-w-xs">
                        <option disabled selected>Procedimento</option>
                        <option value="0">Ressonância</option>
                        <option value="1">Tomografia</option>
                    </select>
                </div>

                <div class="max-w-xs p-2">
                    <button type="submit" name="enviar" class="btn btn-success rounded-sm">Iniciar</button>
                </div>

            </form>
        </div>
    </div>

</body>
