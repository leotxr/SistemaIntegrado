<div class="py-2 mx-auto space-y-2 max-w-7xl" wire:poll.10000ms>
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        @php 
        $status = \Modules\HelpDesk\Entities\TicketStatus::find($activeStatus);
        @endphp
        <x-title>Chamados {{$status->description}}</x-title>
        {{$tickets->links()}}
        <x-table>
            <x-slot name='head' >
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
            </x-slot>
            <x-slot name='body'>
                @foreach($tickets as $ticket)
                @php
                $solicitante = $ticket->find($ticket->id)->TicketRequester;
                $categoria = $ticket->find($ticket->id)->TicketCategory;
                @endphp
                <x-table.row class="text-xs">
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
                        {{$categoria->name}}
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>
</div>