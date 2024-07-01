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
                    <div class="h-2 ">
                        <div wire:loading>
                            <span class="relative flex w-full">
                                <span class="absolute inline-flex w-8 h-1 animate-bar bg-sky-500"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-4">
                    <x-input-label for="sector" :value="__('Setor')" class="text-lg font-bold"/>
                    <x-text-input type='text' name="sector" id="sector" wire:model.defer='saving.sector'
                                  class="w-full"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.sector')"/>
                </div>
                <div class="m-4">
                    <x-input-label for="item" :value="__('Equipamento ou Item')" class="text-lg font-bold"/>
                    <x-text-input type='text' name="item" id="item" wire:model.defer='saving.item'
                                  class="w-full"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.item')"/>
                </div>
                <div class="m-4">
                    <x-input-label for="title" :value="__('Assunto da Solicitação')" class="text-lg font-bold"/>
                    <x-text-input type='text' name="title" id="title" wire:model.defer='saving.title'
                                  class="w-full"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.title')"/>
                </div>
                <div class="m-4">
                    <x-input-label for="description" :value="__('Descrição do Serviço')" class="text-lg font-bold"/>
                    <div>
                        <div class="mt-2 bg-white" wire:ignore>
                            <div class="h-64" x-data x-ref="quillEditor" x-init="
                            quill = new Quill($refs.quillEditor, {theme: 'snow'});
                            quill.on('text-change', function () {
                              $dispatch('input', quill.root.innerHTML);
                            });
                          " wire:model='saving.description'>


                            </div>
                        </div>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('saving.description')"/>
                </div>

                <div class="m-4 inline-flex space-x-2">
                    <a href="{{route('helpdesk.guest.index')}}">
                        <x-secondary-button>Cancelar</x-secondary-button>
                    </a>
                    <x-primary-button type="submit" wire:target="save" wire:loading.attr="disabled">Abrir Solicitação
                    </x-primary-button>
                </div>

            </form>
        </fieldset>
    </div>
</div>