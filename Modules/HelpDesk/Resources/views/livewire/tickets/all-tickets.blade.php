<div>


    <div>
        <div class="mt-4">
            <x-text-input type="text" wire:model='search' placeholder="Buscar solicitações...">
            </x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('exam.exam')" />
        </div>
    </div>
    {{$tickets->links()}}
    <x-table>
        <x-slot name="head">
            <x-table.heading sortable wire:click="sortBy('tickets.id')"
                :direction="$sortField === 'tickets.id' ? $sortDirection : null">Protocolo</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('tickets.ticket_open')"
                :direction="$sortField === 'ticket.ticket_open' ? $sortDirection : null">Data</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('tickets.title')"
                :direction="$sortField === 'tickets.title' ? $sortDirection : null">Assunto</x-table.heading>
            <x-table.heading sortable wire:click="sortBy('tickets.requester_id')"
                :direction="$sortField === 'tickets.requester_id' ? $sortDirection : null">Solicitante
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('tickets.category_id')"
                :direction="$sortField === 'ticket.category_id' ? $sortDirection : null">Categoria</x-table.heading>

            <x-table.heading sortable wire:click="sortBy('tickets.sub_category_id')"
                :direction="$sortField === 'tickets.sub_category_id' ? $sortDirection : null">Sub-Categoria
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('tickets.user_id')"
                :direction="$sortField === 'tickets.user_id' ? $sortDirection : null">Atendente
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('tickets.status_id')"
                :direction="$sortField === 'ticket.status_id' ? $sortDirection : null">Status</x-table.heading>

        </x-slot>

        <x-slot name="body">
            @foreach ($tickets as $ticket)
            @php
            $solicitante = $ticket->find($ticket->id)->TicketRequester;
            $atendente = $ticket->find($ticket->id)->TicketUser;
            $status = $ticket->find($ticket->id)->TicketStatus;
            $categoria = $ticket->find($ticket->id)->TicketCategory;
            $subcategoria = $ticket->find($ticket->id)->TicketSubCategory;
            @endphp
            <x-table.row style="cursor: pointer;" class="text-xs hover:bg-gray-100 dark:hover:bg-gray-700"
            wire:click='callShow({{$ticket->id}})'>
                <x-table.cell>{{
                    $ticket->id }}</x-table.cell>
                <x-table.cell>{{ $ticket->ticket_open ?? '?' }}</x-table.cell>
                <x-table.cell>{{ $ticket->title ?? '?' }}</x-table.cell>
                <x-table.cell>{{ $solicitante->name }}</x-table.cell>
                <x-table.cell>{{ $categoria->name ?? '?' }}</x-table.cell>
                <x-table.cell>{{ $subcategoria->name ?? '?' }}</x-table.cell>
                <x-table.cell>{{ $atendente->name ?? 'Sem atendente' }}</x-table.cell>
                <x-table.cell>{{ $status->name ?? '?'
                    }}
                </x-table.cell>

            </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
    {{$tickets->links()}}

    @livewire('helpdesk::tickets.crud.show-ticket')
</div>