
    <x-nc::modal wire:model.defer="open" maxWidth="3xl">
        <x-slot:title>
            <x-title class="text-white">Histórico</x-title>
        </x-slot:title>
        <x-slot:content>
            <div>
                <x-table>
                    <x-slot:head>
                        <x-table.heading>Data</x-table.heading>
                        <x-table.heading>Campo alterado</x-table.heading>
                        <x-table.heading>Valor Antigo</x-table.heading>
                        <x-table.heading>Novo Valor</x-table.heading>
                        <x-table.heading>Atualizado por</x-table.heading>
                    </x-slot:head>
                    <x-slot:body>
                        @isset($changes)
                            @foreach($changes as $change)
                                <x-table.row>
                                    <x-table.cell>{{$change->created_at}}</x-table.cell>
                                    <x-table.cell>{{$change->changed_field}}</x-table.cell>
                                    <x-table.cell>{{$change->old_value}}</x-table.cell>
                                    <x-table.cell>{{$change->new_value}}</x-table.cell>
                                    <x-table.cell>{{$change->userHistory->name}}</x-table.cell>
                                </x-table.row>
                            @endforeach
                        @endisset
                    </x-slot:body>
                </x-table>
            </div>
        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </div>

        </x-slot:footer>

    </x-nc::modal>

