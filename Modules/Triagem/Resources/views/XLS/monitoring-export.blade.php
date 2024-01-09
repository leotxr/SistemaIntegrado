<x-table>
    <!-- head -->

    <x-slot:head>
        <x-table.heading>Hora Exame</x-table.heading>
        <x-table.heading>Aguardando</x-table.heading>
        <x-table.heading>Inicio Triagem</x-table.heading>
        <x-table.heading>Fim Triagem</x-table.heading>
        <x-table.heading>Entrada Exame</x-table.heading>
        <x-table.heading>Saída Exame</x-table.heading>
        <x-table.heading>Nome</x-table.heading>
        <x-table.heading>Enfermeira</x-table.heading>
        <x-table.heading>Procedimento</x-table.heading>
        <x-table.heading>Status</x-table.heading>

    </x-slot:head>
    <x-slot:body>

        @foreach ($pacientes as $paciente)

            @php

                $a = $triagens->where('patient_id', $paciente->PACIENTEID)->value('patient_id');
                $sigma_term = $triagens->where('patient_id', $paciente->PACIENTEID)->first();
                //echo $a;
                if ($a == $paciente->PACIENTEID) {
                $status = 'REALIZADO';
                $color = 'bg-green-100';
                } else {
                $status = 'AGUARDANDO';
                $color = 'bg-red-100';
                }

            @endphp

            <x-table.row>
                <x-table.cell class="{{ $color }}">{{ $paciente->HORA }}</x-table.cell>
                <x-table.cell class="{{ $color }}">{{ gmdate('H:i:s', $paciente->CHEGOU) }}</x-table.cell>
                <x-table.cell>
                    {{isset($sigma_term['start_hour']) ? $sigma_term['start_hour'] : 'Não iniciada'}}</x-table.cell>
                <x-table.cell>
                    {{isset($sigma_term['final_hour']) ? $sigma_term['final_hour'] : 'Não finalizada'}}</x-table.cell>
                <x-table.cell class="{{ $color }}">{{ $paciente->ENTRADA }}</x-table.cell>
                <x-table.cell class="{{ $color }}">{{ $paciente->SAIDA }}</x-table.cell>
                <x-table.cell class="{{ $color }}">{{ $paciente->PACIENTE }}</x-table.cell>
                <x-table.cell class="{{ $color }}">{{ $sigma_term->relUserTerm->name }}</x-table.cell>
                <x-table.cell class="{{ $color }}">{{ $paciente->PROCEDIMENTO }}</x-table.cell>
                <x-table.cell class="{{ $color }}">
                    <strong>{{ $status }}</strong>
                </x-table.cell>
            </x-table.row>

        @endforeach
    </x-slot:body>
</x-table>
