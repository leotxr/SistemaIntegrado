<div>
    <div class="flex justify-center w-full p-4 bg-white dark:bg-gray-900">
        <fieldset>
            <form wire:submit.prevent='save' enctype="multipart/form-data">
                @csrf
                <div class="m-4">
                    <x-input-label for="requester_id" :value="__('Solicitante')" class="text-lg font-bold" />
                    <x-select name='requester_id' wire:model.defer='saving.requester_id' id="requester_id" class="w-24 sm:w-96 dark:text-gray-100">
                        <x-slot name='option'>
                            <option class="text-gray-900 dark:text-gray-100" selected> Selecione </option>
                            @foreach($requesters as $requester)
                            <x-select.option value="{{$requester->id}}">
                                {{$requester->name}} {{$requester->lastname}}
                            </x-select.option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.category_id')" />
                </div>
                <div class="m-4">
                    <x-input-label for="category_id" :value="__('Selecionar Categoria')" class="text-lg font-bold" />
                    <x-select name='category_id' wire:model='saving.category_id' id="category_id" class="w-24 sm:w-96 dark:text-gray-100">
                        <x-slot name='option'>
                            <option selected> Selecione </option>
                            @foreach($categories as $category)
                            <x-select.option value="{{$category->id}}">
                                {{$category->name}}
                            </x-select.option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.category_id')" />
                </div>
                <div wire:loading>
                    <div class="m-4">
                        <div class="text-center">
                            <div role="status">
                                <svg aria-hidden="true"
                                    class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Carregando</span>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($subcategories)>0)
                <div wire:loading.remove class="m-4">
                    <div>
                        <x-input-label for="subcategory_id" :value="__('Selecionar Sub-Categoria')"
                            class="text-lg font-bold" />
                        <x-select name='subcategory_id' wire:model.defer='saving.sub_category_id' id="subcategory_id"
                            class="w-24 sm:w-96 dark:text-gray-100">
                            <x-slot name='option'>
                                <option selected> Selecione </option>
                                @foreach($subcategories as $subcategory)
                                <x-select.option value="{{$subcategory->id}}">
                                    {{$subcategory->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('saving.sub_category_id')" />
                    </div>
                </div>
                @endif

                <div class="m-4">
                    <x-input-label for="ticket_title" :value="__('Assunto')" class="text-lg font-bold" />
                    <x-text-input type='text' name="ticket_title" id="ticket_title" wire:model.defer='saving.title' class="w-full"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.title')" />
                </div>
                <div class="m-4">
                    <x-input-label for="ticket_description" :value="__('Mensagem')" class="text-lg font-bold" />
                    <div>
                        <div class="mt-2 bg-white" wire:ignore>
                            <div class="h-64" x-data x-ref="quillEditor" x-init="
                            quill = new Quill($refs.quillEditor, {theme: 'snow'});
                            quill.on('text-change', function () {
                              $dispatch('input', quill.root.innerHTML);
                            });
                          " wire:model.defer='saving.description'>
                          
                          {!! $description !!}
                            </div>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.description')" />
                </div>

                <div class="m-4">
                    <x-input-label for="ticket_files" :value="__('Anexar arquivos')" class="text-lg font-bold" />
                    <input type="file" name="ticket_files[]" id="ticket_files" wire:model='ticket_files'
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        multiple />
                    <x-input-error class="mt-2" :messages="$errors->get('ticket_files')" />
                </div>
                <div class="grid grid-cols-2 gap-2 m-4 sm:grid-cols-4">
                    @if($ticket_files)
                    <label class="block text-xs font-medium text-gray-700">Fotos Anexadas</label>
                    @foreach($ticket_files as $file)
                    <div>
                        <a href="{{ $file->temporaryUrl() }}" target="_blank()">
                            <img class="w-6 border-gray-700 rounded-full max-h-6" src="{{ $file->temporaryUrl() }}">
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="m-4">
                    <button type="submit" 
                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none w-full focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Criar
                        Chamado</button>
                </div>
                
            </form>
        </fieldset>
    </div>
</div>