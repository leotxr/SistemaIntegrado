<div class="p-2 space-y-2">
    <div class="p-2 space-y-2">
        <x-title class="uppercase font-bold">Detalhes da solicitação</x-title>
        <div class="space-y-2 border-y border-y-gray-300 dark:border-y-gray-700 py-2">
            <x-quill-editor image="{{$ticket->ticketRequester->profile_img ?? ''}}"
                            title="Solicitante"
                            description="{{$ticket->ticketRequester ? $ticket->ticketRequester->name . ' ' . $ticket->ticketRequester->lastname : 'Sem solicitante vinculado' }}">
            </x-quill-editor>
            <x-quill-editor title="Data/Hora Solicitação"
                            description="{{$ticket->created_at ? date('d/m/y H:i:s', strtotime($ticket->created_at)) : 'Não iniciado'}}">

            </x-quill-editor>
            <x-quill-editor title="Categoria"
                            description="{{$ticket->TicketCategory->name}}">

            </x-quill-editor>
            <x-quill-editor title="Sub-Categoria"
                            description="{{$ticket->TicketSubCategory->name}}">

            </x-quill-editor>
            <x-quill-editor title="Prioridade"
                            description="{{$ticket->TicketCategory->relPriority->name}}">

            </x-quill-editor>
        </div>
    </div>
    @if($ticket->ticketUser)
        <div class="p-2 space-y-2">
            <x-title class="uppercase font-bold">Detalhes do atendimento</x-title>
            <div class="space-y-2 border-y border-y-gray-300 dark:border-y-gray-700 py-2">
                <x-quill-editor image="{{$ticket->ticketUser->profile_img ?? ''}}"
                                title="Atendente"
                                description="{{$ticket->ticketUser ? $ticket->ticketUser->name . ' ' . $ticket->ticketUser->lastname : 'Sem atendente vinculado' }}">
                </x-quill-editor>
                <x-quill-editor title="Início do atendimento"
                                description="{{$ticket->ticket_start ? date('d/m/y H:i:s', strtotime($ticket->ticket_start)) : 'Não iniciado'}}">

                </x-quill-editor>
                <x-quill-editor title="Final do atendimento"
                                description="{{$ticket->ticket_close ? date('d/m/y H:i:s', strtotime($ticket->ticket_close)) : 'Não finalizado'}}">

                </x-quill-editor>
                <x-quill-editor title="Tempo de atendimento"
                                description="{{$ticket->total_ticket ? date('H:i:s', $ticket->total_ticket) : 'Não finalizado'}}">

                </x-quill-editor>
            </div>
        </div>
    @endif
</div>