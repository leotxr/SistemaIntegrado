<div class="bg-white rounded-md grid grid-cols-1 sm:grid-cols-3 border">
    <div class="w-full px-2">
        <label class="label font-bold" for="nome">
            Nome:
        </label>
        <input type="text" name="nome" id="nome" class="input w-full max-w-md text-md"
            readonly value=" {{ $paciente->NOME }} " />
        <input type="text" name="pacienteid" id="pacienteid"
            class="input w-full max-w-md text-md hidden" readonly
            value=" {{ $paciente->PACIENTEID }} " />

    </div>
    <div class="max-w-sm px-2">
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

    <div class="max-w-sm px-2">
        <label class="label font-bold" for="nome">
            Início da Triagem:
        </label>
        <input type="text" name="start" id="start" class="input w-full max-w-xs text-md"
            readonly value="{{ $start }}" />
    </div>

    <div class="max-w-sm px-2">
        <label class="label font-bold" for="nome">
            Procedimento
        </label>
        <input type="text" name="procedimento" id="procedimento" class="input w-full max-w-xs text-md"
            readonly value="{{ $paciente->DESCRICAO }}" />
    </div>



</div>