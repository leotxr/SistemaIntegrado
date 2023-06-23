@isset($finishing)

<form wire:submit.prevent='finish'>
    @csrf
<x-modal.dialog wire:model.defer='modalFinish'>

    <x-slot name='title'>
        <x-title>Finalizar Chamado #{{$finishing->id}} - {{$finishing->title}}</x-title>
    </x-slot>
    <x-slot name='content'>
        <div>
            <x-input-label for='finish_mesage'>Mensagem de Finalização</x-input-label>
            <x-text-area rows="7" wire:model.defer='message' name="finish_message" id="finish_message"> </x-text-area>
        </div>
        <div class="grid grid-cols-2 gap-3">
            <div class="mt-4">
                <x-input-label for="ticket_start" :value="__('Inicio do atendimento')" />
                <input type="datetime-local" step='1' class="input" name="ticket_start" id="ticket_start" wire:model.defer='finishing.ticket_start' />
                <x-input-error class="mt-2" :messages="$errors->get('finishing.ticket_start')" />
            </div>
            <div class="mt-4">
                <x-input-label for="exam" :value="__('Hora de Finalização')" />
                <input type="datetime-local" step='1' value="{{$ticket_close}}" class="input" name="ticket_close" id="ticket_close" />
                <x-input-error class="mt-2" :messages="$errors->get('ticket_close')" />
            </div>
            @isset($finishing->total_pause)
            <div class="mt-4">
                <x-input-label for="total_pause" :value="__('Tempo de Pausa')" />
                <input x-mask="99:99:99" step='1' class="input" name="total_pause" id="total_pause" wire:model.defer='finishing.total_pause'/>
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