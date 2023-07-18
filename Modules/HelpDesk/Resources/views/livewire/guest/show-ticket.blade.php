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
                <div class="font-bold">{{date('d/m/Y H:i:s', strtotime($ticket->ticket_close))}}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="my-4">
        <div x-data="{ open: false }" x-on:click="open = ! open" class="border border-gray-300">
            <div class="grid justify-start">
                <button class="px-2 py-4 text-2xl font-light">Mais detalhes
                </button>
            </div>
            <div>
                <div x-show="open" x-transition:enter="transition ease-in-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-full"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-full">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
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
                                    @if($ticket->ticket_close){{date('d/m/Y H:i:s',
                                    strtotime($ticket->ticket_close))}}@endif</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <div class="max-w-3xl p-8 m-4">
            <x-title class="grid justify-start"> Histórico de mensagens</x-title>
            @php
            $messages = $ticket->find($ticket->id)->TicketMessages;
            @endphp
            <ol class="relative p-4 bg-white border-l border-gray-200 dark:border-gray-700 dark:bg-gray-800">
                @isset($messages)
                @foreach($messages as $message)
                @php
                $user_message = $message->find($message->id)->MessageUser;
                @endphp
                <li class="mb-10 ml-6 bg-slate-50 dark:bg-gray-900">
                    <span
                        class="absolute flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full -left-5 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                        <img class="rounded-full shadow-lg" src="{{URL::asset('storage/icons/user.png')}}"
                            alt="{{$user_message->name}}" />
                    </span>
                    <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-600">
                        <div class="px-4 font-bold text-left text-gray-900 dark:text-gray-50">{{$user_message->name}}
                        </div>
                        <div class="items-center justify-between p-4 sm:flex ">
                            <time class="mb-1 text-xs font-normal text-gray-600 sm:order-last sm:mb-0">
                                {{date('d/m/Y H:i:s', strtotime($message->created_at))}}
                            </time>
                            <div class="text-sm font-normal text-gray-600 dark:text-gray-300">
                                <div class="max-w-full">
                                    @php
                                    echo $message->message
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
                @endisset

                <li class="mb-10 ml-6 bg-slate-50 dark:bg-gray-800">
                    <span
                        class="absolute flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full -left-5 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                        <img class="rounded-full shadow-lg" src="{{URL::asset('storage/icons/user.png')}}"
                            alt="{{$solicitante->name}}" />
                    </span>
                    <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-600">
                        <div class="px-4 font-bold text-left text-gray-900 dark:text-gray-50">{{$solicitante->name}}
                        </div>
                        <div class="items-center justify-between p-4 sm:flex ">
                            <time class="mb-1 text-xs font-normal text-gray-600 sm:order-last sm:mb-0">
                                {{date('d/m/Y H:i:s', strtotime($ticket->ticket_open))}}
                            </time>
                            <div class="text-sm font-normal text-gray-600 dark:text-gray-300">
                                <div class="max-w-full">
                                    @php
                                    echo $ticket->description
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mb-1 text-sm font-normal text-gray-400 sm:order-last sm:mb-0">Chamado criado</p>
                </li>

            </ol>




        </div>
    </div>
</div>