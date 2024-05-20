<div>
    <div class="flex justify-between">
        <div>
            <x-title class="text-3xl font-bold">#{{$ticket->id}} - {{$ticket->title}}</x-title>
        </div>
        <div>
            <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                  style="background-color: {{$colors[$ticket->ticketStatus->id]}}">
                    {{$ticket->ticketStatus->name}}
            </span>
        </div>
    </div>
    <div>
        @livewire('helpdesk::tickets.ticket-actions', ['ticket' => $ticket], key($ticket->id))
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-6">
        <div class="col-span-2 sm:col-span-4">
            @livewire('helpdesk::guest.ticket-activity', ['ticket' => $ticket], key($ticket->id))
        </div>
        <div class="col-span-2 sm:col-span-2">
            @livewire('helpdesk::guest.ticket-details', ['ticket' => $ticket], key($ticket->id))
        </div>
    </div>

    @livewire('helpdesk::tickets.crud.transfer-ticket')
    @livewire('helpdesk::tickets.crud.finish-ticket')
    @livewire('helpdesk::tickets.crud.edit-ticket')
    @livewire('helpdesk::tickets.crud.pause-ticket')
    @livewire('helpdesk::tickets.crud.delete-ticket')

</div>
