@isset($my_tickets)
<div class="max-w-full py-2 mx-auto space-y-2">
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @php
        $status = \Modules\HelpDesk\Entities\TicketStatus::find($activeStatus);
        @endphp
        <x-title class="text-xl p-2">Meus Chamados Vinculados</x-title>
        {{$my_tickets->links()}}
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
                    Categoria
                </x-table.heading>
                <x-table.heading>
                    Prioridade
                </x-table.heading>
                <x-table.heading>
                    Atendente
                </x-table.heading>
                <x-table.heading>
                    Status
                </x-table.heading>
            </x-slot>
            <x-slot name='body'>
                @foreach($my_tickets as $ticket)
                    @php
                        $solicitante = $ticket->find($ticket->id)->TicketRequester;
                        $categoria = $ticket->find($ticket->id)->TicketCategory;
                        $subcategoria = $ticket->find($ticket->id)->TicketSubCategory;
                        $atendente = $ticket->find($ticket->id)->TicketUser;
                        $prioridade = $categoria->find($categoria->id)->relPriority;
                        $status = $ticket->find($ticket->id)->TicketStatus;
                    @endphp
                    <x-table.row style="cursor: pointer;" class="text-xs hover:bg-gray-100 dark:hover:bg-gray-600"
                                 wire:click='callShow({{$ticket->id}})'>
                        <x-table.cell>
                            #{{$ticket->id}}
                        </x-table.cell>
                        <x-table.cell>
                            {{date('d/m H:i:s', strtotime($ticket->created_at))}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$ticket->title}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$solicitante->name}} {{$solicitante->lastname}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$categoria->name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$prioridade->name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$atendente->name ?? "Sem atendente"}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$status->name}}
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>
</div>
@endisset
