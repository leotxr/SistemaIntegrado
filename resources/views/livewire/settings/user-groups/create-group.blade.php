<div>
    <div class="pb-2">
        <x-title>Novo Grupo</x-title>
    </div>
    <form wire:submit.prevent='save' class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="group_name" :value="__('Nome do grupo')" />
            <x-text-input id="group_name" name="group_name" type="text" wire:model.defer='group.name' class="block w-full mt-1"
                autocomplete="new-group" />
            <x-input-error :messages="$errors->get('group')" class="mt-2" />
        </div>



        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>