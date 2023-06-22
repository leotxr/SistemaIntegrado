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
                <div wire:click="$set('ticketStatus', false)"
                    class="flex items-center justify-center px-4 py-2 text-center transition-transform duration-200 bg-white shadow-md cursor-pointer card lg:transform hover:scale-95 hover:shadow-lg dark:bg-gray-800">
                    <div class="text-xs font-bold text-gray-800 dark:text-gray-50">Chamados Vinculados</div>
                    <div class="p-2 text-blue-600 ">

                        <x-icon name="user-circle" class="w-6 h-6" />


                    </div>

                    <div class="text-2xl font-bold text-blue-600">
                        @php
                        $count = \Modules\HelpDesk\Entities\Ticket::where('user_id',
                        Auth::user()->id)->where('status_id', 4)->count();

                        @endphp
                        {{$count}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="w-full text-center">
        <div class="text-center" wire:loading>
            <div role="status absolute">
                <svg aria-hidden="true"
                    class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div wire:loading.remove>
            @if($ticketStatus)
            @include('helpdesk::dashboard.tables.table-tickets')
            @else
            @include('helpdesk::dashboard.tables.table-my-tickets')
            @endif
        </div>
    </div>

    @include('helpdesk::dashboard.modals.modal-show')
    @include('helpdesk::dashboard.modals.modal-edit')
    @include('helpdesk::dashboard.modals.modal-finish')
    @include('helpdesk::dashboard.modals.modal-pause')
    @include('helpdesk::dashboard.modals.modal-transfer')
    @include('helpdesk::dashboard.modals.modal-delete')

</div>