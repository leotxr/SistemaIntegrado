<div>
    @php
    $solicitante = $ticket->find($ticket->id)->TicketRequester;
    $atendente = $ticket->find($ticket->id)->TicketUser;
    $categoria = $ticket->find($ticket->id)->TicketCategory;
    $subcategoria = $ticket->find($ticket->id)->TicketSubCategory;
    $status = $ticket->find($ticket->id)->TicketStatus;
    $messages = $ticket->find($ticket->id)->TicketMessages;
    $messages = $messages->sortDesc();
    @endphp
    <div class="flex-wrap my-2">
        <div class="text-start">
            <x-title class="text-3xl font-bold text-gray-900 dark:text-gray-50">Detalhes do Chamado <span
                    class="text-blue-600">
                    #{{$ticket->id}}</span> </x-title>
        </div>
        <div class="my-1 ml-8 text-end">
            <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                style="background-color: {{$colors[$status->id]}}">
                {{$status->name}}
            </span>
        </div>
    </div>
    <div class="grid gap-4 sm:grid-cols-1 lg:grid-cols-3 md:grid-cols-1">
        <div
            class="p-4 text-gray-900 bg-white rounded-lg shadow-md lg:col-span-2 md:col-span-1 sm:col-span-1 bg-opacity-80 dark:bg-gray-800 dark:text-gray-50">
            <x-title class="text-xl font-bold text-gray-900 dark:text-gray-50">Assunto: <span
                    class="text-gray-500 dark:text-white">{{$ticket->title}}</span></x-title>
            <div class="max-w-full p-4">
                <ol class="relative p-4 bg-white border-l border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                    @isset($messages)
                    @foreach($messages as $message)
                    @php
                    $user_message = $message->find($message->id)->MessageUser;
                    @endphp
                    <li class="mb-10 ml-6 bg-slate-50 dark:bg-gray-900">
                        <span
                            class="absolute flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full -left-5 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            @if(isset($user_message->profile_img))
                            <img class="w-12 h-12 rounded-full shadow-lg"
                                src="{{URL::asset($user_message->profile_img)}}" alt="{{$user_message->name}}" />
                            @else
                            <img class="w-12 h-12 rounded-full shadow-lg" src="{{URL::asset('storage/icons/user.png')}}"
                                alt="{{$user_message->name}}" />
                            @endif
                        </span>
                        <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-600">
                            <div class="px-4 font-bold text-left text-gray-900 dark:text-gray-50">
                                {{$user_message->name}}
                            </div>
                            <div class="items-center justify-between p-4 sm:flex ">
                                <time class="mb-1 text-xs font-normal text-gray-600 sm:order-last sm:mb-0">
                                    {{date('d/m/Y H:i:s', strtotime($message->created_at))}}
                                </time>
                                <div class="text-sm font-normal text-gray-600 dark:text-gray-300">{{$message->message}}
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endisset

                    <li class="mb-10 ml-6 bg-slate-50 dark:bg-gray-800">
                        <span
                            class="absolute flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full -left-5 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            @if(isset($solicitante->profile_img))
                            <img class="w-12 h-12 rounded-full shadow-lg"
                                src="{{URL::asset($solicitante->profile_img)}}" alt="{{$solicitante->name}}" />
                            @else
                            <img class="w-12 h-12 rounded-full shadow-lg" src="{{URL::asset('storage/icons/user.png')}}"
                                alt="{{$solicitante->name}}" />
                            @endif
                        </span>
                        <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-600">
                            <div class="px-4 font-bold text-left text-gray-900 dark:text-gray-50">{{$solicitante->name}}
                            </div>
                            <div class="items-center justify-between p-4 sm:flex ">
                                <time class="mb-1 text-xs font-normal text-gray-600 sm:order-last sm:mb-0">
                                    {{date('d/m/Y H:i:s', strtotime($ticket->created_at))}}
                                </time>
                                <div class="text-sm font-normal text-gray-600 dark:text-gray-300">
                                    {{$ticket->description}}
                                </div>
                            </div>
                        </div>
                        <p class="mb-1 text-sm font-normal text-gray-400 dark:text-gray-300 sm:order-last sm:mb-0">
                            Chamado criado</p>
                    </li>
                    @if($ticket->status_id === 4)
                    <li class="mt-2 ml-6" x-data="{ open: false }">
                        <form wire:submit.prevent='sendMessage({{$ticket->id}})'>
                            @csrf
                            <x-secondary-button x-on:click="open = ! open">Inserir Mensagem</x-secondary-button>
                            <div class="mt-2 text-end" x-show="open" x-transition>
                                <x-text-area wire:model.defer='message' name="message" id="message"></x-text-area>

                                <x-primary-button class="mt-2">
                                    <x-icon name='paper-airplane' class="w-5 h-5"></x-icon>
                                </x-primary-button>
                            </div>
                        </form>
                    </li>
                    @endif
                </ol>
            </div>
        </div>
        <div class="p-4 text-gray-900 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-50 max-h-36">
            <x-title class="text-xl font-bold text-gray-900 dark:text-gray-50">Solicitante</x-title>
            <div class="flex">
                <div class="my-2 mr-2">
                    @if($solicitante->profile_img != null)
                    <img class="w-12 h-12 rounded-full" src="{{URL::asset($solicitante->profile_img)}}"
                        alt="{{$solicitante->name}}">
                    @else
                    <x-icon name="user-circle" class="w-12 h-12 text-gray-400" />
                    @endif
                </div>
                <div class="my-4 mr-4 text-lg font-medium text-gray-900 dark:text-gray-50">
                    {{$solicitante->name}} {{$solicitante->lastname}}
                    <p class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">{{$solicitante->email}}</p>
                </div>
            </div>
        </div>
        <div
            class="col-span-2 p-4 text-gray-900 bg-white rounded-lg shadow-md bg-opacity-80 lg:col-span-2 md:col-span-1 sm:col-span-1 dark:bg-gray-800 dark:text-gray-50">
            <x-title class="text-xl font-bold text-gray-900 dark:text-gray-50">Detalhes da solicitação</x-title>
            <div class="max-w-full mt-3 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Abertura</dt>
                    <dd class="font-semibold text-md">{{date("d/m/Y H:i:s",
                        strtotime($ticket->ticket_open))}}</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Categoria</dt>
                    <dd class="font-semibold text-md">{{$categoria->name}}</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Sub-Categoria</dt>
                    <dd class="font-semibold text-md">{{$subcategoria->name}}</dd>
                </div>


            </div>
        </div>
        <div class="p-4 text-gray-900 bg-white rounded-lg shadow-md bg-opacity-80 dark:bg-gray-800 dark:text-gray-50">
            <x-title class="text-xl font-bold text-gray-900 dark:text-gray-50">Detalhes do atendimento</x-title>
            <div class="w-full mt-3 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">

                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Início do atendimento</dt>
                    <dd class="font-semibold text-md">@isset($ticket->ticket_start){{date("d/m/Y H:i:s",
                        strtotime($ticket->ticket_start))}}@endisset</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Final do atendimento</dt>
                    <dd class="font-semibold text-md">@isset($ticket->ticket_close){{date("d/m/Y H:i:s",
                        strtotime($ticket->ticket_close))}}@endisset</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Tempo total</dt>
                    <dd class="font-semibold text-md">@isset($ticket->total_ticket){{$ticket->total_ticket}}@endisset
                    </dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-md dark:text-gray-400">Atendente</dt>
                    <dd class="font-semibold text-md">@isset($ticket->user_id){{$atendente->name}}@endisset</dd>
                </div>
            </div>
        </div>
    </div>
</div>