@isset($finishing)
<x-modal.dialog wire:model.defer='modalFinish'>
    <x-slot name='title'>
        <x-title>Finalizar Chamado #{{$finishing->id}} - {{$finishing->title}}</x-title>
    </x-slot>
    <x-slot name='content'>
        <div>
            <x-input-label for='finish_mesage'>Mensagem de Finalização</x-input-label>
            <x-text-area rows="7" wire:model.defer='finish_message' name="finish_message" id="finish_message"> </x-text-area>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div class="mt-4">
                <x-input-label for="ticket_open" :value="__('Hora de Início')" />
                <input type="datetime-local" class="input" name="ticket_open" id="ticket_open" wire:model.defer='finishing.ticket_open' />
                <x-input-error class="mt-2" :messages="$errors->get('finishing.ticket_open')" />
            </div>
            <div class="mt-4">
                <x-input-label for="exam" :value="__('Hora de Finalização')" />
                <input type="datetime-local" value="{{$ticket_close}}" class="input" name="ticket_close" id="ticket_close" wire:model.defer='ticket_close'/>
                <x-input-error class="mt-2" :messages="$errors->get('ticket_close')" />
            </div>
            @isset($finishing->start_pause)
            <div class="mt-4">
                <x-input-label for="start_pause" :value="__('Início da Pausa')" />
                <input type="datetime-local" class="input" name="start_pause" id="start_pause" wire:model.defer='finishing.ticket_start_pause'/>
                <x-input-error class="mt-2" :messages="$errors->get('finishing.ticket_start_pause')" />
            </div>
            <div class="mt-4">
                <x-input-label for="end_pause" :value="__('Fim da Pausa')" />
                <input type="datetime-local" class="input" name="end_pause" id="end_pause" wire:model.defer='finishing.ticket_end_pause'/>
                <x-input-error class="mt-2" :messages="$errors->get('finishing.ticket_end_pause')" />
            </div>
            @endisset
        </div>
    </x-slot>
    <x-slot name='footer'>
        <x-primary-button type="submit">Finalizar</x-primary-button>
    </x-slot>
</x-modal.dialog>
@endisset