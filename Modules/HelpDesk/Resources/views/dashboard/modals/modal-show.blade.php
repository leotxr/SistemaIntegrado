@isset($showing)
@php
$status = $showing->find($showing->id)->TicketStatus;
@endphp
<x-modal.form wire:model.defer='modalTicket'>
    <x-slot name='title'>

        <x-title>Detalhes do Chamado: #{{$showing->id}} - {{$showing->title}}</x-title>
        <div class='justify-items-end'>
            <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                style="background-color: {{$colors[$status->id]}}">
                {{$status->name}}
            </span>
        </div>
    </x-slot>
    <x-slot name='content'>
        <div class="max-w-3xl p-8">
            @php
            $messages = $showing->find($showing->id)->TicketMessages;
            $messages = $messages->sortDesc();
            $solicitante = $showing->find($showing->id)->TicketRequester;
            @endphp
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
                        <img class="w-12 h-12 rounded-full shadow-lg" src="{{URL::asset($user_message->profile_img)}}"
                            alt="{{$user_message->name}}" />
                        @else
                        <img class="w-12 h-12 rounded-full shadow-lg" src="{{URL::asset('storage/icons/user.png')}}"
                            alt="{{$user_message->name}}" />
                        @endif
                    </span>
                    <div class="border border-gray-200 rounded-lg shadow-sm dark:border-gray-600">
                        <div class="px-4 font-bold text-left text-gray-900 dark:text-gray-50">{{$user_message->name}}
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
                        <img class="w-12 h-12 rounded-full shadow-lg" src="{{URL::asset($solicitante->profile_img)}}"
                            alt="{{$solicitante->name}}" />
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
                                {{date('d/m/Y H:i:s', strtotime($showing->ticket_open))}}
                            </time>
                            <div class="text-sm font-normal text-gray-600 dark:text-gray-300">{{$showing->description}}
                            </div>
                        </div>
                    </div>
                    <p class="mb-1 text-sm font-normal text-gray-400 dark:text-gray-300 sm:order-last sm:mb-0">Chamado criado</p>
                </li>
                @if($showing->status_id === 4)
                <li class="mt-2 ml-6" x-data="{ open: false }">
                    <form wire:submit.prevent='sendMessage({{$showing->id}})'>
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
    </x-slot>
    <x-slot name='subcontent'>
        @isset($showing->ticket_close)
        <div class="inline-flex">
            <div class="font-bold text-md">Tempo de Atendimento: <span class="font-light text-md">{{$total}}</span>
            </div>
        </div>
        @endisset
    </x-slot>
    <x-slot name='footer' class="space-x-4">
        <div>
            <div class="dropdown dropdown-top dropdown-end">
                <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 dark:bg-gray-600 dark:text-gray-50 rounded-box w-52">
                    @if($showing->status_id === 4)
                    <li><a wire:click='openPauseTicket({{$showing->id}})'><x-icon name="pause" class="w-4 h-4"/> Pausar</a></li>
                    <li><a wire:click='openTransferTicket({{$showing->id}})'><x-icon name="switch-horizontal" class="w-4 h-4"/> Transferir</a></li>
                    @endif
                    <li><a wire:click='openEditTicket({{$showing->id}})'> <x-icon name="pencil" class="w-4 h-4"/> Editar</a></li>
                    <li><a wire:click='openDeleteTicket({{$showing->id}})'> <x-icon name="trash" class="w-4 h-4"/> Excluir</a></li>
                </ul>
                <button tabindex="0">
                    <x-icon name="dots-horizontal" class="w-6 h-6 dark:text-gray-50" />
                </button>


            </div>
        </div>

        @if($showing->status_id === 1)
        <x-primary-button class="mx-2 bg-blue-800" wire:click='startTicket({{$showing->id}})'>Atender</x-primary-button>
        @endif
        @if($showing->status_id === 4)
        <x-primary-button class="mx-2 bg-blue-600 hover:bg-blue-400" wire:click='openFinishTicket({{$showing->id}})'>
            Finalizar
        </x-primary-button>
        @endif
        @if($showing->status_id === 2)
        <x-secondary-button wire:click='confirmReopen()'>Reabrir</x-secondary-button>
        @endif
        @if($showing->status_id === 3)
        <x-secondary-button wire:click='endPause({{$showing->id}})'>Retomar Atendimento</x-secondary-button>
        @endif
    </x-slot>
</x-modal.form>
@endisset