<div>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Cadastrar Prioridade</x-title>
            <form wire:submit.prevent='save'>
                <div class="m-4">
                    <x-input-label for="priority_name" :value="__('Nome')" />
                    <x-text-input type="text" wire:model.defer='priority.name' name='priority_name'
                        id="priority_name"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('priority.name')" />
                </div>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="priority_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='priority.description'
                            name='priority_description' id="priority_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('priority.description')" />
                    </div>
                    
                </div>
                <div class="m-4">
                    <x-input-label for="priority_order" :value="__('Ordem de exibição')" />
                    <x-text-input type="number" wire:model.defer='priority.order' name='priority_order'
                        class="w-16" id="priority_order">
                    </x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('priority.order')" />
                </div>
                <div class="m-4">
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
                <div>
                    @if (session()->has('message'))
                    <div class="text-white bg-green-700 alert">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Editar Prioridade</x-title>
            <form wire:submit.prevent='update'>
                <div class="m-4">
                    <x-input-label for="priority_id" :value="__('Selecionar Prioridade')" />
                    <x-select type="text" wire:model.defer='priority' name='priority_id' id="priority_id">
                        <x-slot name='option'>
                            <option selected>Selecione</option>
                            @foreach($priorities as $priority)
                            <x-select.option value="{{$priority->id}}">
                                {{$priority->name}}
                            </x-select.option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('priority.category_id')" />
                </div>
                
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="priority_name" :value="__('Nome')" />
                        <x-text-input type="text" wire:model.defer='editingpriority.name' name='priority_name'
                            id="priority_name"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('priority.name')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="priority_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='editingpriority.description'
                            name='priority_description' id="priority_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('priority.description')" />
                    </div>
                    
                </div>
                <div class="m-4">
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
                <div>
                    @if (session()->has('update_message'))
                    <div class="text-white bg-green-700 alert">
                        {{ session('update_message') }}
                    </div>
                    @endif
                </div>
            </form>
            
        </div>
    </div>
    <div class="pt-2">
        {{$priorities->links()}}
        <x-table>
            <x-slot name='head'>
                <x-table.heading>
                    Codigo
                </x-table.heading>
                <x-table.heading>
                    Nome
                </x-table.heading>
                <x-table.heading>
                    Descrição
                </x-table.heading>
            </x-slot>
            <x-slot name='body'>
                @foreach($priorities as $priority)
                <x-table.row>
                    <x-table.cell>
                        {{$priority->id}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$priority->name}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$priority->description}}
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>


<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>

</div>
