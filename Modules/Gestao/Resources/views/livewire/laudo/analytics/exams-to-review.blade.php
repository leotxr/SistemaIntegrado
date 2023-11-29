<div class="">
    <div class="pb-4">
        <x-title class="text-4xl">Exames pendentes de Revisão</x-title>
        <span class="text-sm font-light text-gray-500 dark:text-gray-200">Mostrando resultados de {{date('d/m/Y', strtotime($start_date))}} à {{date('d/m/Y', strtotime($end_date))}}</span>
    </div>
    <x-table>
        <x-slot name="head">
            <x-table.heading>MÉDICO</x-table.heading>
            @foreach($setores as $setor)
                <x-table.heading>{{substr($setor, 0, 6)}}</x-table.heading>
            @endforeach
            <x-table.heading>TOTAL</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($medicos as $medico)
                <x-table.row>
                    <x-table.cell class="border-r text-center" :class="$medico === '' ? 'font-bold' : ''">{{$medico === "" ? 'SEM MÉDICO ASSINANTE' : $medico}}</x-table.cell>
                    @foreach($setores as $setor)
                        <x-table.cell class="border-r text-center">{{$db->where("MEDICO", $medico)->where('NOMESETOR', $setor)->count()}}</x-table.cell>
                    @endforeach
                    <x-table.cell class="border-r font-bold text-center">{{$db->where('MEDICO', $medico)->count()}}</x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
</div>
