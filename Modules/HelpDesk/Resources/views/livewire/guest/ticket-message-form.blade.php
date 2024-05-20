<div>
    <form wire:submit.prevent="save">
        <div>

            <div>
                <x-input-label for="ticket_description" :value="__('Mensagem')" class="text-lg font-bold"/>
                <div class="mt-2 bg-white dark:bg-gray-800 dark:text-gray-100" wire:ignore>
                    <div class="h-24 dark:bg-gray-900 dark:text-gray-100" x-data x-ref="quillEditor" x-init="
                            quill = new Quill($refs.quillEditor, {theme: 'snow'});
                            quill.on('text-change', function () {
                              $dispatch('input', quill.root.innerHTML);
                            });
                            document.addEventListener('notify', event => {
                                    quill.setContents([]);
                            })
                          " wire:model='message'>

                    </div>
                </div>
                <div class="flex justify-end my-1 space-x-2">
                    <div>
                        @if($ticket_files)
                            <span class="flex content-center text-xs font-medium text-gray-700"><a class="flex content-center cursor-pointer" wire:click="clearFiles"><x-icon name="x" class="w-4 h-4 text-red-600"></x-icon> </a>{{count($ticket_files)}} Arquivos anexados</span>
                        @endif
                    </div>
                    <div class="flex justify-items-center">
                        <input type="file" class="hidden" id="ticket_files" name="ticket_files[]" wire:model="ticket_files" multiple/>
                        <label for="ticket_files">
                            <a class="cursor-pointer">
                                <x-icon name="paper-clip" class="w-6 h-6"></x-icon>
                            </a>
                        </label>
                    </div>
                    <x-primary-button type="submit">Enviar</x-primary-button>
                </div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('message')"/>
        </div>
    </form>
</div>
