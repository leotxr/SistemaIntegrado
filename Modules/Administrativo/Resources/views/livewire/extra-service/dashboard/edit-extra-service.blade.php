<div>
    @isset($extra_service)
        <x-modal.dialog wire:model.defer="modalEdit">
            <x-slot:title>
                <div class="flex justify-between">
                    <x-title>#{{$extra_service->id}} - {{$extra_service->title}}</x-title>
                    <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                          style="background-color: {{$colors[$extra_service->status->id]}}">
                    {{$extra_service->status->name}}
                </span>
                </div>
            </x-slot:title>
            <x-slot:content>
                <div class="space-y-2">
                    <div>
                        <span class="text-md font-regular text-gray-600 dark:text-gray-200">Setor:</span>
                        <span class="text-md font-bold text-gray-700 dark:text-gray-100">{{$extra_service->sector}}</span>
                    </div>
                    <div>
                        <span class="text-md font-regular text-gray-600 dark:text-gray-200">Equipamento/Item:</span>
                        <span class="text-md font-bold text-gray-800 dark:text-gray-100">{{$extra_service->item}}</span>
                    </div>
                    <div class="py-2">
                        <x-message-row image="{{URL::asset($extra_service->requester->profile_img)}}"
                                       user="{{$extra_service->requester->name . ' ' . $extra_service->requester->lastname}}"
                                       time="{{date('d/m/Y h:i:s', strtotime($extra_service->created_at))}}">
                            @php
                                echo $extra_service->description;
                            @endphp
                        </x-message-row>
                    </div>
                </div>
            </x-slot:content>
            <x-slot:footer>
                <div class="flex space-x-2">
                    <x-dropdown align="bottom">
                        <x-slot:trigger>
                            <x-icon name="dots-horizontal" class="w-6 h-6 dark:text-gray-50 cursor-pointer"/>
                        </x-slot:trigger>
                        <x-slot:content>
                            <x-dropdown-link class="cursor-pointer" wire:click="pause">
                                <span>Pausar</span>
                            </x-dropdown-link>
                            <x-dropdown-link class="cursor-pointer" wire:click="finishAndOpenTicket">
                                <span>Enviar para o TI</span>
                            </x-dropdown-link>
                        </x-slot:content>
                    </x-dropdown>
                    <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
                    @if($extra_service->status_id == 1)
                        <x-primary-button type="button" wire:click="start">Atender</x-primary-button>
                    @elseif($extra_service->status_id == 3)
                        <x-primary-button type="button" wire:click="start">Retomar Atendimento</x-primary-button>
                    @elseif($extra_service->status_id == 4)
                        <x-primary-button type="button" wire:click="openFinish">Finalizar</x-primary-button>
                    @endif
                </div>
            </x-slot:footer>
        </x-modal.dialog>

        <!-- MODAL DE FINALIZAÇÃO -->
        <form wire:submit.prevent="finish">
            @csrf
            <x-modal.dialog wire:model.defer="modalFinish">

                <x-slot:title>
                    <x-title>Finalização da Solicitação</x-title>
                </x-slot:title>
                <x-slot:content>
                    <div class="max-w-full mx-12 space-y-2">
                        <x-title>Ação Tomada:</x-title>
                        <div>
                            <div class="mt-2 text-gray-900 bg-white dark:bg-gray-100 dark:text-white">
                                <x-text-area rows="5" class="rounded-md" wire:model="message"></x-text-area>
                            </div>
                        </div>
                    </div>
                </x-slot:content>
                <x-slot:footer>
                    <x-secondary-button class="mx-2" x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button type="submit">Finalizar</x-primary-button>
                </x-slot:footer>

            </x-modal.dialog>
        </form>
    @endisset
</div>
