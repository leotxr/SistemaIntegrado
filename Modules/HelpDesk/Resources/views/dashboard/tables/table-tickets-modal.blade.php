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
                        Assunto
                    </x-table.heading>
                    <x-table.heading>
                        Solicitante
                    </x-table.heading>
                    <x-table.heading>
                        Categoria
                    </x-table.heading>
                    <x-table.heading>
                        Abrir
                    </x-table.heading>
                </x-slot>
                <x-slot name='body'>
                    @foreach($tickets as $ticket)
                    @php
                    $solicitante = $ticket->find($ticket->id)->TicketRequester;
                    $categoria = $ticket->find($ticket->id)->TicketCategory;
                    $subcategoria = $ticket->find($ticket->id)->TicketSubCategory;
                    $atendente = $ticket->find($ticket->id)->TicketUser;
                    $prioridade = $categoria->find($categoria->id)->relPriority;
                    $setor = $solicitante->find($solicitante->id)->relUserGroup;
                    @endphp
                    <x-table.row style="cursor: pointer;" class="text-xs hover:bg-gray-100 dark:hover:bg-gray-600" >
                        <x-table.cell>
                            #{{$ticket->id}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$ticket->title}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$solicitante->name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$categoria->name}}
                        </x-table.cell>
                        <x-table.cell>
                            <a href="{{route('helpdesk.tickets.edit', ['id' => $ticket->id])}}" target="_blank"
                                >
                                <x-icon name="external-link" class="w-6 h-6 dark:text-gray-50" />
                            </a>
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        @endisset
    </div>
</div>