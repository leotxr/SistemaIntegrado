<div class="w-lg bg-white rounded-md grid grid-cols-2 sm:grid-cols-3">
    <div class="w-full">
        <label class="label font-bold" for="nome">
            Nome:
        </label>
        <input type="text" name="nome" id="nome" class="input w-full max-w-md text-md"
            readonly value=" {{ $paciente->NOME }} " />
        <input type="text" name="pacienteid" id="pacienteid"
            class="input w-full max-w-md text-md hidden" readonly
            value=" {{ $paciente->PACIENTEID }} " />

    </div>
    <div class="max-w-sm">
        <label class="label font-bold" for="nome">
            Data de Nascimento:
        </label>
        <input type="text" name="patient_age" id=""
            class="input max-w-md text-md hidden"
            readonly />{{ date('d/m/Y', strtotime($paciente->DATANASC)) }}

        <input type="text" name="nascimento" id="nascimento"
            class="input max-w-md text-md hidden" readonly
            value=" {{ $paciente->DATANASC }} " />
    </div>

    <div class="max-w-sm">
        <label class="label font-bold" for="nome">
            Início da Triagem:
        </label>
        <input type="text" name="start" id="start" class="input w-full max-w-xs text-md"
            readonly value="{{ $start }}" />
    </div>



</div>