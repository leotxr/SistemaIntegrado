<div>
    @isset($showing)
        @php
            $status = $showing->find($showing->id)->TicketStatus;
        @endphp
        <x-modal.form wire:model.defer='modalTicket' maxWidth="5xl">
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
                @livewire('helpdesk::guest.ticket-activity', ['ticket' => $showing], key($showing->id))
            </x-slot>
            <x-slot name='subcontent'>
                <div class="flex">
                    @isset($showing->ticket_close)
                        <div class="inline-flex">
                            <div class="font-bold text-md dark:text-gray-100">Tempo de Atendimento: <span
                                        class="font-light text-md">{{$total}}</span>
                            </div>
                        </div>
                    @endisset
                    <div class="mx-4 border-l">
                        @foreach($showing->TicketFiles as $file)
                            <div class="inline-flex mx-4">
                                <a href="{{ URL::asset($file->url) }}" target="_blank()">
                                    <img class="w-6 border-gray-700 rounded-full max-h-6"
                                         src="{{ URL::asset($file->url) }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </x-slot>
            <x-slot name='footer' class="space-x-4">
                <div class="flex justify-between" x-data="{popover: false}">
                <span x-show="popover" class="order-1 inline-block dark:text-gray-50" x-transition>
                    Abrir em nova aba
                </span>
                    <a class="order-last" href="{{route('helpdesk.tickets.edit', ['id' => $showing->id])}}"
                       target="_blank"
                       x-on:mouseover="popover = true" x-on:mouseleave="popover = false">
                        <x-icon name="external-link" class="w-6 h-6 dark:text-gray-50"/>
                    </a>

                </div>

                <div>
                    <div class="mx-4 dropdown dropdown-top dropdown-end">
                        <ul tabindex="0"
                            class="p-2 shadow dropdown-content menu bg-base-100 dark:bg-gray-600 dark:text-gray-50 rounded-box w-52">
                            @if($showing->status_id === 4)
                                <li><a wire:click='callPause({{$showing->id}})'>
                                        <x-icon name="pause" class="w-4 h-4"/>
                                        Pausar
                                    </a></li>
                                <li><a wire:click="$emit('TicketTransfer', {{$showing->id}})">
                                        <x-icon name="switch-horizontal" class="w-4 h-4"/>
                                        Transferir
                                    </a></li>
                            @endif
                            <li><a wire:click='callEdit({{$showing->id}})'>
                                    <x-icon name="pencil" class="w-4 h-4"/>
                                    Editar
                                </a></li>
                            <li><a wire:click='callDelete({{$showing->id}})'>
                                    <x-icon name="trash" class="w-4 h-4"/>
                                    Excluir
                                </a></li>
                        </ul>
                        <button tabindex="0">
                            <x-icon name="dots-horizontal" class="w-6 h-6 dark:text-gray-50"/>
                        </button>


                    </div>
                </div>

                <x-secondary-button class="mx-2 " x-on:click="$dispatch('close')">
                    Fechar
                </x-secondary-button>
                @if($showing->status_id === 1)
                    <x-primary-button class="mx-2 bg-blue-800" wire:click='callStart({{$showing->id}})'>Atender
                    </x-primary-button>
                @endif
                @if($showing->status_id === 4)
                    <x-primary-button class="mx-2 bg-blue-600 hover:bg-blue-400"
                                      wire:click='callFinish({{$showing->id}})'>
                        Finalizar
                    </x-primary-button>
                @endif
                @if($showing->status_id === 2)
                    <x-secondary-button wire:click="$emit('TicketReopen', {{$showing->id}})">Reabrir
                    </x-secondary-button>
                @endif
                @if($showing->status_id === 3)
                    <x-secondary-button wire:click="$emit('TicketEndPause', {{$showing->id}})">Retomar Atendimento
                    </x-secondary-button>
                @endif
            </x-slot>
        </x-modal.form>
    @endisset

    @livewire('helpdesk::tickets.crud.transfer-ticket')
    @livewire('helpdesk::tickets.crud.edit-ticket')
    @livewire('helpdesk::tickets.crud.finish-ticket')
    @livewire('helpdesk::tickets.crud.pause-ticket')
    @livewire('helpdesk::tickets.crud.delete-ticket')

</div>