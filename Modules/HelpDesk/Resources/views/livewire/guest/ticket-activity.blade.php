<div class="w-full">
    <div class="p-2 border border-gray-300 dark:border-gray-700 rounded-lg space-y-2 bg-white dark:bg-gray-800"
         x-data="{message_form: false}">
        <div class="w-full flex justify-end">
            <x-secondary-button type="button" x-on:click="message_form = ! message_form"><span
                        class="transition transform duration-300" :class="message_form ? 'rotate-45' : 'rotate-0'"><x-icon
                            name="plus" class="w-4 h-4"></x-icon></span>Nova mensagem
            </x-secondary-button>
        </div>
        <div x-show="message_form">
            @livewire('helpdesk::guest.ticket-message-form', ['ticket' => $ticket], key($ticket->id))
        </div>
        <div>
            <x-title class="uppercase font-bold">Atividade</x-title>
        </div>
        <div>
            @foreach($ticket->ticketMessages->sortByDesc('created_at') as $message)
                <x-message-row image="{{URL::asset($message->messageUser->profile_img)}}"
                               user="{{$message->messageUser->name}}"
                               time="{{$message->created_at->format('d/m/y H:i:s')}}">
                    @php
                        echo "$message->message\n";
                    @endphp
                </x-message-row>
            @endforeach
        </div>
        <div x-data="{ show: false }">
            <div>
                <a class="cursor-pointer" x-on:click="show = ! show">Ver mais</a>
            </div>
            <div x-show="show">
                <x-message-row image="{{$ticket->TicketRequester->profile_img}}"
                               user="{{$ticket->TicketRequester->name}}"
                               time="{{$ticket->created_at->format('d/m/y H:i:s')}}">
                    @php
                        echo "$ticket->description\n";
                    @endphp
                </x-message-row>
            </div>
        </div>
    </div>

</div>
