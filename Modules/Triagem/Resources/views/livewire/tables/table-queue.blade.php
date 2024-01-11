<div>
    <div class="overflow-y-auto md:h-96 sm:h-full lg:h-full">
        <x-table>
            <x-slot:head>
                <x-table.heading>Ações</x-table.heading>
                <x-table.heading>Hora Exame</x-table.heading>
                <x-table.heading>ID</x-table.heading>
                <x-table.heading>Nome</x-table.heading>
                <x-table.heading>Procedimento</x-table.heading>
                <x-table.heading>Status</x-table.heading>
            </x-slot:head>
            <x-slot:body>
                @foreach ($pacientes as $paciente)

                    @php

                        $a = $triagens->where('patient_id', $paciente->PACIENTEID)->value('patient_id');

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
                        <x-table.cell class="{{ $color }}">
                            @if($status != 'REALIZADO')
                                <a type="button"
                                   href="{{ route('create.triagem', ['setor_id' => $setor->xclinic_id, 'paciente_id' => $paciente->PACIENTEID]) }}"
                                   value="{{ $paciente->PACIENTEID }}"
                                   class="mx-2 btn btn-info">
                                    <x-icon name="plus" class="w-6 h-6"></x-icon>
                                </a>
                            @endif
                        </x-table.cell>
                        <x-table.cell class="{{ $color }}">{{ $paciente->HORA }}</x-table.cell>
                        <x-table.cell class="{{ $color }}">{{ $paciente->PACIENTEID }}</x-table.cell>
                        <x-table.cell class="{{ $color }}">{{ $paciente->PACIENTE }}</x-table.cell>
                        <x-table.cell class="{{ $color }}">{{ $paciente->PROCEDIMENTO }}</x-table.cell>
                        <x-table.cell class="{{ $color }}"><strong>{{ $status }}</strong></x-table.cell>
                    </x-table.row>

                @endforeach

            </x-slot:body>
        </x-table>
    </div>

</div>
