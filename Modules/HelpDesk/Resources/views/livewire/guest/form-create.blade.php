<div>
    <div class="flex justify-end m-2">
        <a type="button" href="{{route('helpdesk.guest.index')}}"
           class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">Cancelar</a>
    </div>
    <div class="flex justify-center w-full p-4 bg-white dark:bg-gray-800">
        <fieldset>
            <form wire:submit.prevent='save' enctype="multipart/form-data">
                @csrf
                <div class="m-4">
                    <div>
                        <x-input-label for="category_id" :value="__('Selecionar Categoria')"
                                       class="text-lg font-bold"/>
                        <x-select name='category_id' wire:model='saving.category_id' id="category_id"
                                  class="w-full">
                            <x-slot name='option'>
                                <option selected> Selecione</option>
                                @foreach($categories as $category)
                                    <x-select.option value="{{$category->id}}">
                                        {{$category->name}}
                                    </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('saving.category_id')"/>
                    </div>
                    <div class="h-2 ">
                        <div wire:loading wire:target='saving.category_id'>
                            <span class="relative flex w-full">
                                <span class="absolute inline-flex w-8 h-1 animate-bar bg-sky-500"></span>
                            </span>
                        </div>
                    </div>
                </div>

                @if(count($subcategories)>0)
                    <div class="m-4">
                        <div>
                            <x-input-label for="subcategory_id" :value="__('Selecionar Sub-Categoria')"
                                           class="text-lg font-bold"/>
                            <x-select name='subcategory_id' wire:model.defer='saving.sub_category_id'
                                      id="subcategory_id"
                                      class="w-full">
                                <x-slot name='option'>
                                    <option selected> Selecione</option>
                                    @foreach($subcategories as $subcategory)
                                        <x-select.option value="{{$subcategory->id}}">
                                            {{$subcategory->name}}
                                        </x-select.option>
                                    @endforeach
                                </x-slot>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('saving.sub_category_id')"/>
                        </div>
                    </div>
                @endif

                <div class="m-4">
                    <x-input-label for="ticket_title" :value="__('Assunto')" class="text-lg font-bold"/>
                    <x-text-input type='text' name="ticket_title" id="ticket_title" wire:model.defer='saving.title'
                                  class="w-full"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.title')"/>
                </div>
                <div class="m-4">
                    <x-input-label for="ticket_description" :value="__('Mensagem')" class="text-lg font-bold"/>
                    <div>
                        <div class="mt-2 bg-white" wire:ignore>
                            <div class="h-64" x-data x-ref="quillEditor" x-init="
                            quill = new Quill($refs.quillEditor, {theme: 'snow'});
                            quill.on('text-change', function () {
                              $dispatch('input', quill.root.innerHTML);
                            });
                          " wire:model='saving.description'>

                                {!! $saving->description !!}
                            </div>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.description')"/>
                </div>

                <div class="m-4">
                    <x-input-label for="ticket_files" :value="__('Anexar arquivos')" class="text-lg font-bold"/>
                    <input type="file" name="ticket_files[]" id="ticket_files" wire:model='ticket_files'
                           class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           multiple/>
                    <x-input-error class="mt-2" :messages="$errors->get('ticket_files')"/>
                </div>
                <div class="grid grid-cols-2 gap-2 m-4 sm:grid-cols-4">
                    @if($ticket_files)
                        <label class="block text-xs font-medium text-gray-700">Fotos Anexadas</label>
                        @foreach($ticket_files as $file)
                            <div>
                                <a href="{{ $file->temporaryUrl() }}" target="_blank()">
                                    <img class="w-6 border-gray-700 rounded-full max-h-6"
                                         src="{{ $file->temporaryUrl() }}">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="m-4 inline-flex space-x-2">
                    <a href="{{route('helpdesk.guest.index')}}">
                        <x-secondary-button>Cancelar</x-secondary-button>
                    </a>
                    <x-primary-button type="submit" wire:target="save" wire:loading.attr="disabled">Criar
                        Chamado
                    </x-primary-button>
                </div>

            </form>
        </fieldset>
    </div>
</div>