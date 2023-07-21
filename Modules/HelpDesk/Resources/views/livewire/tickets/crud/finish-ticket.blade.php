<div>
    @isset($finishing)

    <form wire:submit.prevent='finish'>
        @csrf
        <x-modal.dialog wire:model.defer='modalFinish'>

            <x-slot name='title'>
                <x-title>Finalizar Chamado #{{$finishing->id}} - {{$finishing->title}}</x-title>
            </x-slot>
            <x-slot name='content'>
                <div>
                    <div class="mt-2 bg-white" wire:ignore>
                        <div class="h-64" x-data x-ref="quillEditor" x-init="
                        quill = new Quill($refs.quillEditor, {
                            theme: 'snow'});
                        quill.on('text-change', function () {
                          $dispatch('input', quill.root.innerHTML);
                        });
                      " wire:model='message'>
                      
                      {!! $message !!}
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="mt-4">
                        <x-input-label for="ticket_start" :value="__('Inicio do atendimento')" />
                        <input type="datetime-local" step='1' class="input dark:bg-gray-700 dark:text-gray-100"
                            name="ticket_start" id="ticket_start" wire:model.defer='finishing.ticket_start' />
                        <x-input-error class="mt-2" :messages="$errors->get('finishing.ticket_start')" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="ticket_close" :value="__('Hora de Finalização')" />
                        <input type="datetime-local" step='1' value="{{now()}}"
                            class="input dark:bg-gray-700 dark:text-gray-100" name="ticket_close" id="ticket_close" />
                        <x-input-error class="mt-2" :messages="$errors->get('ticket_close')" />
                    </div>
                    @isset($finishing->total_pause)
                    <div class="mt-4">
                        <x-input-label for="total_pause" :value="__('Tempo de Pausa')" />
                        <input x-mask="99:99:99" step='1' class="input" name="total_pause" id="total_pause"
                            wire:model.defer='finishing.total_pause' />
                        <x-input-error class="mt-2" :messages="$errors->get('finishing.total_pause')" />
                    </div>
                    @endisset
                </div>
            </x-slot>
            <x-slot name='footer'>
                <x-primary-button type="submit">Finalizar</x-primary-button>
            </x-slot>

        </x-modal.dialog>
    </form>
    @endisset
</div>