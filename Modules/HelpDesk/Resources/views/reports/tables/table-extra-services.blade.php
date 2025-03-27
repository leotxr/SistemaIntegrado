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
                            Titulo
                        </x-table.heading>
                        <x-table.heading>
                            Descrição
                        </x-table.heading>
                        <x-table.heading>
                            Solicitante
                        </x-table.heading>
                        <x-table.heading>
                            Setor
                        </x-table.heading>
                        <x-table.heading>
                            Item
                        </x-table.heading>
                        <x-table.heading>
                            Ação
                        </x-table.heading>
                        <x-table.heading>
                            Status
                        </x-table.heading>
                        <x-table.heading>
                            Ticket TI
                        </x-table.heading>
                    </x-slot>
                    <x-slot name='body'>
                        @foreach ($tickets as $ticket)
                            <x-table.row style="cursor: pointer;" class="text-xs hover:bg-gray-100 dark:hover:bg-gray-600">
                                <x-table.cell>
                                    #{{ $ticket->id }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ date('d/m H:i:s', strtotime($ticket->datahora)) }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $ticket->titulo }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ trim(strip_tags($ticket->descricao)) }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $ticket->solicitante }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $ticket->setor }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $ticket->item }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $ticket->acao }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{ $ticket->status }}
                                </x-table.cell>
                                <x-table.cell>
                                    {{$ticket->ticket_ti == 1 ? 'SIM' : 'NAO'}}
                                </x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        @endisset
    </div>
</div>
