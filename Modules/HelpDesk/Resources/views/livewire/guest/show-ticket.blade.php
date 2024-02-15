<div>
    <div class="text-start">
        <x-title class="text-3xl font-bold">#{{$ticket->id}} - {{$ticket->title}}</x-title>
    </div>
    <div class="grid justify-end">
        <div class="flex">
            <div>
                @php
                    $status = $ticket->find($ticket->id)->TicketStatus;
                    $solicitante = $ticket->find($ticket->id)->TicketRequester;
                    $atendente = $ticket->find($ticket->id)->TicketUser;
                    $categoria = $ticket->find($ticket->id)->TicketCategory;

                @endphp
                <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                      style="background-color: {{$colors[$status->id]}}">
                    {{$status->name}}
                </span>
            </div>
            <div>
                @if($ticket->ticket_close)
                    <div
                        class="font-bold dark:text-gray-50 text-gray-700">{{date('d/m/Y H:i:s', strtotime($ticket->ticket_close))}}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="my-4">
        <div x-data="{ open: false }" x-on:click="open = ! open"
             class="border border-gray-300 dark:border-gray-700 hover:dark:bg-gray-700 dark:bg-gray-800 bg-white hover:bg-gray-50 shadow-md rounded-lg">
            <div class="grid justify-start">
                <button class="px-2 py-4 text-2xl font-light text-gray-800 dark:text-gray-50">Mais detalhes
                </button>
            </div>
            <div>
                <div x-show="open" x-transition:enter="transition ease-in-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-full"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in-out duration-300"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-full">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 text-gray-700 dark:text-gray-50">
                        <div class="mx-2 mt-4">
                            <div class="flex text-lg font-bold">Solicitante: <span class="space-x-1 font-light">
                                    {{$solicitante->name}}</span></div>
                        </div>
                        <div class="mx-2 mt-4">
                            <div class="flex text-lg font-bold">Atendente: <span class="space-x-1 font-light">
                                    {{$atendente->name ?? "Sem atendente vinculado"}}</span></div>
                        </div>
                        <div class="mx-2 mt-4">
                            <div class="flex text-lg font-bold">Categoria: <span class="space-x-1 font-light">
                                    {{$categoria->name ?? "Sem categoria"}}</span></div>
                        </div>
                        <div class="mx-2 mt-4">
                            <div class="flex text-lg font-bold">Abertura: <span class="space-x-1 font-light">
                                    {{date('d/m/Y
                                    H:i:s', strtotime($ticket->ticket_open)) ?? "Sem data"}}</span></div>
                        </div>
                        <div class="mx-2 mt-4">
                            <div class="flex text-lg font-bold">Encerramento: <span class="space-x-1 font-light">
                                    @if($ticket->ticket_close)
                                        {{date('d/m/Y H:i:s',
                                                                            strtotime($ticket->ticket_close))}}
                                    @endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <div class="max-w-full p-8 m-4">
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
                    <span class="dark:text-white text-gray-900 w-full">Chamado aberto
                    </span>
                </li>

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
                                <span class="font-bold dark:text-white text-gray-900 w-full">{{$user_message->name}}</span>
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
    </div>
</div>
