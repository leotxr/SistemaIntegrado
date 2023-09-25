@if($orcamentos instanceof \Illuminate\Pagination\AbstractPaginator)

   {{$orcamentos->links()}}

@endif
<x-table>
    <x-slot name="head">
        <x-table.heading>
            Data de Criação
        </x-table.heading>
        <x-table.heading>
            Paciente
        </x-table.heading>
        <x-table.heading>
            Telefone
        </x-table.heading>
        <x-table.heading>
            Valor
        </x-table.heading>
        <x-table.heading>
            Data de Alteração
        </x-table.heading>
        <x-table.heading>
            Último usuário
        </x-table.heading>
        <x-table.heading>
            Status
        </x-table.heading>
    </x-slot>
    <x-slot name="body">
        @foreach($orcamentos as $orcamento)
        @php
        $status_orcamento = $orcamento->find($orcamento->id)->relStatus;
        $last_user = $orcamento->find($orcamento->id)->lastUser;
        @endphp
        <x-table.row class="cursor-pointer hover:bg-gray-100">
            <x-table.cell>
                {{date('d/m/Y H:i:s', strtotime($orcamento->created_at))}}
            </x-table.cell>
            <x-table.cell>
                {{$orcamento->patient_name}}
            </x-table.cell>
            <x-table.cell>
                {{$orcamento->patient_phone}}
            </x-table.cell>
            <x-table.cell>
                R$ {{$orcamento->total_value}}
            </x-table.cell>
            <x-table.cell>
                {{date('d/m/Y H:i:s', strtotime($orcamento->updated_at))}}
            </x-table.cell>
            <x-table.cell>
                {{$last_user->name}}
            </x-table.cell>
            <x-table.cell>
                <span class="text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded  dark:text-gray-300"
                    style="background-color: {{$status_orcamento->color}}">{{$status_orcamento->name}}</span>
            </x-table.cell>
        </x-table.row>
        @endforeach
    </x-slot>
</x-table>