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

@isset($reopening)
<form wire:submit.prevent='reopen'>
    @csrf
<x-modal.confirmation wire:model.defer='modalReopen'>

    <x-slot name='dialog'>
        <x-title>Reabrir chamado #{{$reopening->id}}-{{$reopening->title}}?</x-title>
        <p class="text-sm text-gray-500 mb-4 dark:text-gray-100 font-light">As horas de trabalho serão zeradas! Deseja continuar?</p>
    </x-slot>

    <x-slot name='buttons'>
        <x-secondary-button x-on:click="$dispatch('close')"  class="mx-2">Cancelar</x-secondary-button>
        <x-primary-button class="mx-2" type="submit">Reabrir</x-primary-button>
    </x-slot>

</x-modal.confirmation>
</form>
@endisset