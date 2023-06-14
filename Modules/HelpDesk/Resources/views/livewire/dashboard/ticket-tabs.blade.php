<div>
    <div class="grid gap-3 lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1">
        <div class="grid gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($priorities as $priority)
            <div class="cursor-pointer active:scale-95">
                <div
                    class="flex items-center justify-center px-4 py-8 text-center transition-transform duration-200 bg-white shadow-md card lg:transform hover:scale-95 hover:shadow-lg dark:bg-gray-800">
                    <div class="p-2 text-blue-600 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                        </svg>
                        @php
                        $count = \Modules\HelpDesk\Entities\Ticket::join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
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
            </div>
            @endforeach
        </div>
        <div>
            <div class="grid gap-5 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4">
                @foreach($statuses as $status)

                <div wire:click='selectStatus({{$status->id}})'
                    class="flex items-center justify-center px-4 py-8 text-center transition-transform duration-200 bg-white shadow-md cursor-pointer card lg:transform hover:scale-95 hover:shadow-lg dark:bg-gray-800">
                    <div class="text-xs font-bold text-gray-800 dark:text-gray-50">{{$status->description}}</div>
                    <div class="p-2 text-blue-600 ">
                        <span class="leading-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                        </span>

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
        <section>
            @livewire('helpdesk::dashboard.ticket-charts')
        </section>
        <aside>
            @include('helpdesk::dashboard.tables.table-tickets')
        </aside>

    </div>
    <div>
        @livewire('helpdesk::dashboard.ticket-stats')
    </div>
</div>