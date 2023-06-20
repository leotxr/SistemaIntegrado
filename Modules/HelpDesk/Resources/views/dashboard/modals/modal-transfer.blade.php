@isset($transfering)
<form wire:submit.prevent='transfer'>
    @csrf
<x-modal.dialog wire:model.defer='modalTransfer'>

    <x-slot name='title'>
        <x-title>Transferir Chamado #{{$transfering->id}} - {{$transfering->title}}</x-title>
    </x-slot>
    <x-slot name='content'>
        <x-input-label for="user_id" :value="__('Selecionar Usuário')" class="text-lg font-bold" />
        <x-select name='user_id' wire:model='transfering.user_id' id="user_id" class="w-24 sm:w-96">
            <x-slot name='option'>
                <option selected> Selecione </option>
                @foreach($users as $user)
                <x-select.option value="{{$user->id}}">
                    {{$user->name}}
                </x-select.option>
                @endforeach
            </x-slot>
        </x-select>
    </x-slot>
    <x-slot name='footer'>
        <x-secondary-button x-on:click="$dispatch('close')"  class="mx-2">Cancelar</x-secondary-button>
        <x-primary-button class="mx-2" type="submit">Transferir Chamado</x-primary-button>
    </x-slot>

</x-modal.dialog>
</form>
@endisset