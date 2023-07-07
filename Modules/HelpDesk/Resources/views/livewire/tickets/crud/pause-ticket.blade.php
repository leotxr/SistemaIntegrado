<div>
    @isset($pausing)
    <form wire:submit.prevent='pause'>
        @csrf
    <x-modal.dialog wire:model.defer='modalPause'>
    
        <x-slot name='title'>
            <x-title>Pausar Chamado #{{$pausing->id}} - {{$pausing->title}}</x-title>
        </x-slot>
        <x-slot name='content'>
            <div>
                <x-input-label for='pause_mesage'>Motivo</x-input-label>
                <x-text-area rows="7" wire:model.defer='message' name="pause_message" id="pause_message"> </x-text-area>
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button x-on:click="$dispatch('close')"  class="mx-2">Cancelar</x-secondary-button>
            <x-primary-button class="mx-2" type="submit">Pausar Chamado</x-primary-button>
        </x-slot>
    
    </x-modal.dialog>
    </form>
    @endisset
</div>
