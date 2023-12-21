<div>
    <x-table>
        <x-slot name="head">
            <x-table.heading>Data Exame</x-table.heading>
            <x-table.heading>Hora Exame</x-table.heading>
            <x-table.heading>Data Entrega</x-table.heading>
            @isset($sum_days)
            <x-table.heading>Entrega p/ Laudo</x-table.heading>
            @endisset
            <x-table.heading>Código</x-table.heading>
            <x-table.heading>Nome</x-table.heading>
            <x-table.heading>Exame</x-table.heading>
            <x-table.heading>Médico</x-table.heading>
            <x-table.heading>Setor</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($db as $exame)
                <x-table.row>
                    <x-table.cell>
                        {{date('d/m/Y', strtotime($exame->DATA_EXAME))}}
                    </x-table.cell>
                    <x-table.cell>
                        {{gmdate('H:i:s', $exame->HORA_EXAME)}}
                    </x-table.cell>
                    <x-table.cell>
                        {{date('d/m/Y', strtotime($exame->DATA_ENTREGA))}}
                    </x-table.cell>
                    @if($sum_days)
                        <x-table.cell>
                            {{date('d/m/Y', strtotime($exame->DATA_ENTREGA . "+$sum_days days"))}}
                        </x-table.cell>
                    @endif
                    <x-table.cell>
                        {{$exame->PACIENTEID}}
                    </x-table.cell>
                    <x-table.cell>{{$exame->PACIENTENOME}}</x-table.cell>
                    <x-table.cell>{{$exame->EXAME}}</x-table.cell>
                    <x-table.cell>{{$exame->MEDICO}}</x-table.cell>
                    <x-table.cell>{{$exame->SETOR}}</x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
</div>
