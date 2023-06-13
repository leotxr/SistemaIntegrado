<div>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Cadastrar Sub-Categoria</x-title>
            <form wire:submit.prevent='save'>
                <div class="m-4">
                    <x-input-label for="subcategory_name" :value="__('Nome')" />
                    <x-text-input type="text" wire:model.defer='subCategory.name' name='subcategory_name'
                        id="subcategory_name"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('subCategory.name')" />
                </div>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="subcategory_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='subCategory.description'
                            name='subcategory_description' id="subcategory_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('subCategory.description')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="category_id" :value="__('Selecionar Categoria')" />
                        <x-select type="text" wire:model.defer='subCategory.ticket_category_id' name='category_id' id="category_id">
                            <x-slot name='option'>
                                <option selected>Selecione</option>
                                @foreach($categories as $category)
                                <x-select.option value="{{$category->id}}">
                                    {{$category->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('subCategory.category_id')" />
                    </div>
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
            <x-title>Editar Sub-Categoria</x-title>
            <form wire:submit.prevent='update'>
                <div class="m-4">
                    <x-input-label for="subCategory_id" :value="__('Selecionar Sub-Categoria')" />
                    <x-select type="text" wire:model.defer='selectSubCategory' name='subCategory_id' id="subCategory_id">
                        <x-slot name='option'>
                            <option selected>Selecione</option>
                            @foreach($subcategories as $subcategory)
                            <x-select.option value="{{$subcategory->id}}">
                                {{$subcategory->name}}
                            </x-select.option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('subCategory.category_id')" />
                </div>
                
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="subcategory_name" :value="__('Nome')" />
                        <x-text-input type="text" wire:model.defer='editingSubCategory.name' name='subcategory_name'
                            id="subcategory_name"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('subCategory.name')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="subcategory_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='editingSubCategory.description'
                            name='subcategory_description' id="subcategory_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('subCategory.description')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="category_id" :value="__('Selecionar Categoria')" />
                        <x-select type="text" wire:model.defer='editingSubCategory.ticket_category_id' name='category_id' id="category_id">
                            <x-slot name='option'>
                                <option selected>Selecione</option>
                                @foreach($categories as $category)
                                <x-select.option value="{{$category->id}}">
                                    {{$category->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('subCategory.category_id')" />
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
        {{$subcategories->links()}}
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
                    Categoria
                </x-table.heading>
            </x-slot>
            <x-slot name='body'>
                @foreach($subcategories as $subcategory)
                @php
                $category = $subcategory->find($subcategory->id)->relCategory;
                @endphp
                <x-table.row>
                    <x-table.cell>
                        {{$subcategory->id}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$subcategory->name}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$subcategory->description}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$category->name}}
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
