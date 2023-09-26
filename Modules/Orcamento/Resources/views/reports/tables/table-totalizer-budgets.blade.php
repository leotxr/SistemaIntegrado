<x-table>
    <x-slot name="head">
        <x-table.heading>
            Último usuário
        </x-table.heading>
        <x-table.heading>
            Total
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
                {{$last_user->name}}
            </x-table.cell>
            <x-table.cell>
               {{$orcamentos}}
            </x-table.cell>
        </x-table.row>
        @endforeach
    </x-slot>
</x-table>