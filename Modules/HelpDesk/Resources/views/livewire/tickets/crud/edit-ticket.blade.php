<div>
    @isset($editing)
    <form wire:submit.prevent='update({{$editing->id}})'>
        @php
        $status = $editing->find($editing->id)->TicketStatus;
        @endphp
        <x-modal.form wire:model.defer='modalEdit'>
            <x-slot name='title'>
                <x-title>Editar Chamado: #{{$editing->id}} - {{$editing->title}}</x-title>
                <div class='justify-items-end'>
                    <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                        style="background-color: {{$colors[$status->id]}}">
                        {{$status->name}}
                    </span>
                </div>

            </x-slot>
            <x-slot name='content'>
                <fieldset>
                    <div class="grid grid-cols-1 sm:grid-cols-2">
                        <div class="m-4">
                            <x-input-label for="category_id" :value="__('Selecionar Categoria')"
                                class="text-lg font-bold" />
                            <x-select name='category_id' wire:model='editing.category_id' id="category_id"
                                class="w-24 sm:w-full">
                                <x-slot name='option'>
                                    <option selected> Selecione </option>
                                    @foreach($categories as $category)
                                    <x-select.option value="{{$category->id}}">
                                        {{$category->name}}
                                    </x-select.option>
                                    @endforeach
                                </x-slot>
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('editing.category_id')" />
                        </div>
                        <div wire:loading wire:target='render'>
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
                        <div class="m-4">
                            <div>
                                <x-input-label for="subcategory_id" :value="__('Selecionar Sub-Categoria')"
                                    class="text-lg font-bold" />
                                <x-select name='subcategory_id' wire:model.defer='editing.sub_category_id'
                                    id="subcategory_id" class="w-24 sm:w-full">
                                    <x-slot name='option'>
                                        <option selected> Selecione </option>
                                        @foreach($subcategories as $subcategory)
                                        <x-select.option value="{{$subcategory->id}}">
                                            {{$subcategory->name}}
                                        </x-select.option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('editing.sub_category_id')" />
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="ticket_open" :value="__('Data/Hora Abertura')" class="text-lg font-bold" />
                        <input type='datetime-local' class="input input-bordered dark:bg-gray-900 dark:border-gray-50" name="ticket_open" id="ticket_open" wire:model.defer='editing.ticket_open'
                            class="w-full">
                        <x-input-error class="mt-2" :messages="$errors->get('editing.ticket_open')" />
                    </div>
                    @isset($editing->ticket_start)
                    <div class="m-4">
                        <x-input-label for="ticket_start" :value="__('Data/Hora Inicio Atendimento')" class="text-lg font-bold" />
                        <input type='datetime-local' class="input input-bordered dark:bg-gray-900 dark:border-gray-50" name="ticket_start" id="ticket_start" wire:model.defer='editing.ticket_start'
                            class="w-full">
                        <x-input-error class="mt-2" :messages="$errors->get('editing.ticket_start')" />
                    </div>
                    @endisset
                    </div>

                    <div class="m-4">
                        <x-input-label for="ticket_title" :value="__('Assunto')" class="text-lg font-bold" />
                        <x-text-input type='text' name="ticket_title" id="ticket_title" wire:model.defer='editing.title'
                            class="w-full"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('editing.title')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="ticket_description" :value="__('Mensagem')" class="text-lg font-bold" />
                        <div class="mt-2 bg-white dark:bg-gray-800 dark:text-gray-50" wire:ignore>
                            <div class="h-64 dark:text-gray-50" x-data x-ref="quillEditor" x-init="
                            quill = new Quill($refs.quillEditor, {
                                theme: 'snow'});
                            quill.on('text-change', function () {
                              $dispatch('input', quill.root.innerHTML);
                            });
                          " wire:model='editing.description'>

                                {!! $editing->description !!}
                            </div>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('editing.description')" />
                    </div>
    </form>
    </fieldset>
    </x-slot>
    <x-slot name='subcontent'>

    </x-slot>
    <x-slot name='footer' class="space-x-4">
        <x-secondary-button class="mx-2" x-on:click="$dispatch('close')">
            Cancelar
        </x-secondary-button>
        <x-primary-button class="mx-2 bg-blue-600 hover:bg-blue-400" type="submit">
            Salvar
        </x-primary-button>
    </x-slot>
    </x-modal.form>
    </form>
    @endisset

    @isset($reopening)
    <form wire:submit.prevent='reopen'>
        @csrf
        <x-modal.confirmation wire:model.defer='modalReopen'>

            <x-slot name='dialog'>
                <x-title>Reabrir chamado #{{$reopening->id}}-{{$reopening->title}}?</x-title>
                <p class="mb-4 text-sm font-light text-gray-500 dark:text-gray-100">As horas de trabalho serão zeradas!
                    Deseja continuar?</p>
            </x-slot>

            <x-slot name='buttons'>
                <x-secondary-button x-on:click="$dispatch('close')" class="mx-2">Cancelar</x-secondary-button>
                <x-primary-button class="mx-2" type="submit">Reabrir</x-primary-button>
            </x-slot>

        </x-modal.confirmation>
    </form>
    @endisset
</div>