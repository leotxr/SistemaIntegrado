<div class="py-2 mx-auto space-y-2 max-w-7xl">
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @isset($tickets)
            <div>
                <x-table>
                    <x-slot name='head'>
                        <x-table.heading>
                            ID
                        </x-table.heading>
                        <x-table.heading>
                            Data
                        </x-table.heading>
                        <x-table.heading>
                            Assunto
                        </x-table.heading>
                        <x-table.heading>
                            Solicitante
                        </x-table.heading>
                        <x-table.heading>
                            Setor
                        </x-table.heading>
                        <x-table.heading>
                            Categoria
                        </x-table.heading>
                        <x-table.heading>
                            Sub-Categoria
                        </x-table.heading>
                        <x-table.heading>
                            Prioridade
                        </x-table.heading>
                        <x-table.heading>
                            Atendente
                        </x-table.heading>
                        <x-table.heading>
                            Tempo
                        </x-table.heading>
                        <x-table.heading>
                            Espera
                        </x-table.heading>
                    </x-slot>
                    <x-slot name='body'>
                        @foreach($tickets as $ticket)
                            <x-table.row style="cursor: pointer;"
                                         class="text-xs hover:bg-gray-100 dark:hover:bg-gray-600">
                                <x-table.cell>
                                    #{{$ticket['ID']}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{date('d/m H:i:s', strtotime($ticket->created_at))}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$ticket->title}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$solicitante->name}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$setor->name ?? "Sem setor"}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$categoria->name}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$subcategoria->name}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$prioridade->name}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$atendente->name ?? "Sem atendente"}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $total ?? "Em atendimento"}}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $wait ?? "Em atendimento"}}
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        @endisset
    </div>
</div>
