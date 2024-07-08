<div>
    @isset($finishing)

        <form wire:submit.prevent='finish'>
            @csrf
            <x-modal.dialog wire:model.defer='modalFinish' maxWidth="5xl">

                <x-slot name='title'>
                    <x-title>Finalizar Chamado #{{$finishing->id}} - {{$finishing->title}}</x-title>
                </x-slot>
                <x-slot name='content'>
                    <div class="max-w-full p-2">
                        <div>
                            <div class="mt-2">
                                <livewire:components.trix :wire:key="'trix-'.$finishing->id" :value="$message"></livewire:components.trix>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('message')"/>
                        </div>
                        <div class="grid grid-cols-4 gap-3 sm:grid-cols-8">
                            <div class="col-span-4 mt-4 sm:col-span-2">
                                <x-input-label for="ticket_start" :value="__('Inicio do atendimento')"/>
                                <x-text-input type="datetime-local" step='1'
                                              class="w-full"
                                              name="ticket_start" id="ticket_start"
                                              wire:model.defer='finishing.ticket_start'/>
                                <x-input-error class="mt-2" :messages="$errors->get('finishing.ticket_start')"/>
                            </div>
                            <div class="col-span-4 mt-4 sm:col-span-2">
                                <x-input-label for="ticket_close" :value="__('Hora de Finalização')"/>
                                <x-text-input type="datetime-local" step='1'
                                              class="w-full" name="ticket_close" wire:model="ticket_close"
                                              id="ticket_close"/>
                                <x-input-error class="mt-2" :messages="$errors->get('ticket_close')"/>
                            </div>
                            <div class="">
                                <x-icon name="pencil" class="w-6 h-6 text-gray-700 dark:text-gray-300"/>
                            </div>
                            @isset($finishing->total_pause)
                                <div class="col-span-4 mt-4 sm:col-span-2">
                                    <x-input-label for="total_pause" :value="__('Tempo de Pausa')"/>
                                    <x-text-input x-mask="99:99:99" step='1' class="w-full" name="total_pause"
                                                  id="total_pause"
                                                  wire:model.defer='finishing.total_pause'/>
                                    <x-input-error class="mt-2" :messages="$errors->get('finishing.total_pause')"/>
                                </div>
                            @endisset
                        </div>
                    </div>
                </x-slot>
                <x-slot name='footer'>
                    <x-secondary-button class="mx-2" x-on:click="$dispatch('close')">
                        Cancelar
                    </x-secondary-button>
                    <x-primary-button type="submit">Finalizar</x-primary-button>
                </x-slot>

            </x-modal.dialog>
        </form>
    @endisset
</div>
