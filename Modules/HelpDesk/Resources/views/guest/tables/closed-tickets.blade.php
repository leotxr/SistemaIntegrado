<div class="2-full">
    {{$tickets->links()}}
    <x-table>
        <x-slot name='head'>
            <x-table.heading>
                Protocolo
            </x-table.heading>
            <x-table.heading>
                Assunto
            </x-table.heading>
            <x-table.heading>
                Status
            </x-table.heading>
            <x-table.heading>
                Data Criação
            </x-table.heading>
            <x-table.heading>
                Categoria
            </x-table.heading>
            <x-table.heading>
                Atendente
            </x-table.heading>
        </x-slot>
        <x-slot name='body'>
            @foreach($closed as $ticket)
            @php
            $status = $ticket->find($ticket->id)->TicketStatus;
            $user = $ticket->find($ticket->id)->TicketUser;
            $category = $ticket->find($ticket->id)->TicketCategory;
            @endphp
                <x-table.row x-on:click="window.location.href = '{{route('helpdesk.guest.show',['id' => $ticket->id])}}'">
                    <x-table.cell>
                        #{{$ticket->id}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$ticket->title}}
                    </x-table.cell>
                    <x-table.cell>
                        <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                            style="background-color: {{$colors[$status->id]}}">
                            {{$status->name}}
                        </span>
                    </x-table.cell>
                    <x-table.cell>
                        {{$ticket->created_at->format('d/m/Y H:i:s')}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$category->name}}
                    </x-table.cell>
                    <x-table.cell class="font-bold">
                        {{$user->name}}
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
</div>