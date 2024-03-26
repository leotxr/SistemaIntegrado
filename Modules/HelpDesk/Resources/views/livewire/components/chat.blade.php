<div class="p-4" x-data x-ref="div">
    <div class="max-w-full border border-gray-200 dark:border-gray-700 h-[500px] overflow-auto"
         x-init="div.scrollIntoView({ behavior: 'smooth', block: 'end' })">
        <x-title class="grid justify-start"> Histórico de mensagens</x-title>
        @php
            $messages = $ticket->find($ticket->id)->TicketMessages;
        @endphp
        <ol class="relative p-4 grid justify-items-stretch border-l border-gray-200 dark:border-gray-700 ">
            <li class="justify-self-end px-4 max-w-xl mb-10">
                    <span class="font-bold dark:text-white text-gray-900 w-full">{{$ticket->TicketRequester->name}}
                    </span>
                <div class=" bg-blue-800 dark:bg-blue-600 w-full rounded-lg shadow-lg p-2">
                    <div class="items-center justify-between">
                        <div class="text-lg font-normal text-white">
                            <div class="w-full ">
                                @php
                                    echo $ticket->description;
                                @endphp
                            </div>
                        </div>
                        <span class="mb-1 text-xs font-normal text-gray-300 sm:order-last sm:mb-0 w-full">
                                {{date('d/m/Y H:i:s', strtotime($ticket->ticket_open))}}
                            </span>
                    </div>
                </div>
            </li>
            <span class="text-center dark:text-white text-black">Chamado Aberto</span>

            @isset($messages)
                @foreach($messages as $message)
                    @php
                        $user_message = $message->find($message->id)->MessageUser;
                    @endphp
                    @if(auth()->user()->id === $user_message->id)
                        <li class="justify-self-end px-4 max-w-xl mb-10">
                    @else
                        <li class="justify-self-start px-4 max-w-xl mb-10">
                            @endif
                            <span
                                class="font-bold dark:text-white text-gray-900 w-full">{{$user_message->name}}</span>
                            <div class=" bg-blue-600 dark:bg-blue-800 w-full rounded-lg shadow-lg p-2">
                                <div class="items-center justify-between">
                                    <div class="text-lg font-normal text-white">
                                        <div class="w-full ">
                                            @php
                                                echo $message->message;
                                            @endphp
                                        </div>
                                    </div>
                                    <span
                                        class="mb-1 text-xs font-normal text-gray-300 sm:order-last sm:mb-0 w-full">
                                {{date('d/m/Y H:i:s', strtotime($message->created_at))}}
                            </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @endisset
        </ol>
    </div>

    <div class="w-full grid justify-items-center" x-data="{showInput: true}">
        <div class="fixed bottom-0 z-50 w-1/2 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-lg shadow-lg">
            <div class="dark:bg-gray-800 mt-2 p-2">
                <form wire:submit.prevent="sendMessage">
                    <div class="py-2 grid grid-cols-8 gap-2">
                        <div class="col-span-7">
                            <x-text-input class="w-full" type="text" placeholder="digite aqui sua mensagem"
                                          wire:model.defer="message"></x-text-input>
                        </div>
                        <div class="col-span-1 content-center grid justify-items-center">
                            <div>
                                <a class="w-sm cursor-pointer" type="submit">
                                    <x-icon name="paper-airplane" class="w-6 h-6 dark:text-white text-gray-900"></x-icon>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
