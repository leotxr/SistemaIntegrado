<div>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Cadastrar Categoria</x-title>
            <form wire:submit.prevent='save'>
                <div class="m-4">
                    <x-input-label for="category_name" :value="__('Nome')" />
                    <x-text-input type="text" wire:model.defer='ticketCategory.name' name='category_name'
                        id="category_name"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('ticketCategory.name')" />
                </div>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="category_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='ticketCategory.description'
                            name='category_description' id="category_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('ticketCategory.description')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="category_order" :value="__('Ordem de exibição')" />
                        <x-text-input type="number" wire:model.defer='ticketCategory.order' name='category_order'
                            class="w-16" id="category_order">
                        </x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('ticketCategory.order')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="priority_id" :value="__('Pioridade de Atendimento')" />
                        <x-select type="text" wire:model.defer='ticketCategory.priority_id' name='priority_id'
                            id="priority_id">
                            <x-slot name='option'>
                                <option selected>Selecione</option>
                                @foreach($priorities as $priority)
                                <x-select.option value="{{$priority->id}}">
                                    {{$priority->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('ticketCategory.priority_id')" />
                    </div>
                    <div class="m-4">
                        <x-primary-button type="submit">Salvar</x-primary-button>
                    </div>
                </div>
                <div>
                    @if (session()->has('message'))
                    <div class="alert">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Editar Categoria</x-title>

            <div class="m-4">
                <x-input-label for="category" :value="__('Selecionar Categoria')" />
                <x-select type="text" wire:model='selectCategory' name='category_id' id="category_id">
                    <x-slot name='option'>
                        @foreach($categories as $category)
                        <x-select.option value="{{$category->id}}">
                            {{$category->name}}
                        </x-select.option>
                        @endforeach
                    </x-slot>
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('editingCategory.id')" />
            </div>
            <form wire:submit.prevent='update'>
                <div class="m-4">
                    <x-input-label for="category_name" :value="__('Nome')" />
                    <x-text-input type="text" wire:model.defer='editingCategory.name' name='category_name'
                        id="category_name">
                    </x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('editingCategory.name')" />
                </div>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="category_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='editingCategory.description'
                            name='category_description' id="category_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('editingCategory.description')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="category_order" :value="__('Ordem de exibição')" />
                        <x-text-input type="number" wire:model.defer='editingCategory.order' name='category_order'
                            class="w-16" id="category_order">
                        </x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('editingCategory.order')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="priority_id" :value="__('Pioridade de Atendimento')" />
                        <x-select type="text" wire:model.defer='editingCategory.priority_id' name='priority_id'
                            id="priority_id">
                            <x-slot name='option'>
                                <option selected>Selecione</option>
                                @foreach($priorities as $priority)
                                <x-select.option value="{{$priority->id}}">
                                    {{$priority->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('ticketCategory.priority_id')" />
                    </div>
                    <div class="m-4">
                        <x-primary-button type="submit">Salvar</x-primary-button>
                    </div>
                </div>
                <div>
                    @if (session()->has('update_message'))
                    <div class="alert">
                        {{ session('update_message') }}
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="pt-2">
        {{$categories->links()}}
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
                <x-table.heading>
                    Ordem de exibição
                </x-table.heading>
                <x-table.heading>
                    Prioridade
                </x-table.heading>
            </x-slot>
            <x-slot name='body'>
                @foreach($categories as $category)
                @php
                    $priority = $category->find($category->id)->relPriority;
                @endphp
                <x-table.row>
                    <x-table.cell>
                        {{$category->id}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$category->name}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$category->description}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$category->order}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$priority->name}}
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