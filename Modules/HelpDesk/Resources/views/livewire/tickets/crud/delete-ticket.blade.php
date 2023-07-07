<div>
    @isset($deleting)
    <form wire:submit.prevent='delete'>
        @csrf
    <x-modal.confirmation wire:model.defer='modalDelete'>
    
        <x-slot name='dialog'>
            <x-title>Excluir Chamado #{{$deleting->id}} - {{$deleting->title}}</x-title>
        </x-slot>
    
        <x-slot name='buttons'>
            <x-secondary-button x-on:click="$dispatch('close')"  class="mx-2">Cancelar</x-secondary-button>
            <x-danger-button class="mx-2" type="submit">Excluir</x-danger-button>
        </x-slot>
    
    </x-modal.confirmation>
    </form>
    @endisset
</div>
