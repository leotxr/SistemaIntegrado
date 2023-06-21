<div>
    <div class="grid gap-3 lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1">
        <div class="grid gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($priorities as $priority)
            <a class="cursor-pointer active:scale-95" wire:click="$emit('ticketCreated')">
                <div
                    class="flex items-center justify-center px-4 py-4 text-center transition-transform duration-200 bg-white shadow-md card lg:transform hover:scale-95 hover:shadow-lg dark:bg-gray-800">
                    <div class="p-2 text-blue-600 ">
                        <x-icon name="ticket" class="w-6 h-6" />

                        @php
                        $count = \Modules\HelpDesk\Entities\Ticket::join('ticket_categories', 'tickets.category_id',
                        '=', 'ticket_categories.id')
                        ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
                        ->where('ticket_priorities.id', $priority->id)
                        ->where('tickets.status_id', 1)
                        ->count();
                        @endphp

                    </div>
                    <div class="font-light text-gray-600 text-md dark:text-gray-50">{{$priority->name}}</div>
                    <div class="text-3xl font-bold text-blue-600">
                        {{$count}}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div>
            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
                @php
                $icons = ['home',
                'clock',
                'check-circle',
                'pause',
                'play']
                @endphp
                @foreach($statuses as $status)

                <div wire:click='selectStatus({{$status->id}})'
                    class="flex items-center justify-center px-4 py-2 text-center transition-transform duration-200 bg-white shadow-md cursor-pointer card lg:transform hover:scale-95 hover:shadow-lg dark:bg-gray-800">
                    <div class="text-xs font-bold text-gray-800 dark:text-gray-50">{{$status->description}}</div>
                    <div class="p-2 text-blue-600 ">

                        <x-icon name="{{$icons[$status->id]}}" class="w-6 h-6" />


                    </div>

                    <div class="text-2xl font-bold text-blue-600">
                        @php
                        $count = \Modules\HelpDesk\Entities\Ticket::where('status_id', $status->id)->count();

                        @endphp
                        {{$count}}
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>


    <div class="w-full">
        @include('helpdesk::dashboard.tables.table-tickets')
    </div>


    @include('helpdesk::dashboard.modals.modal-edit')
    @include('helpdesk::dashboard.modals.modal-finish')
    @include('helpdesk::dashboard.modals.modal-pause')
    @include('helpdesk::dashboard.modals.modal-transfer')
    @include('helpdesk::dashboard.modals.modal-delete')

</div>