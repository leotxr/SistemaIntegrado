<div>
    @isset($editing)
        <form wire:submit.prevent='update({{$editing->id}})'>
            @php
                $status = $editing->find($editing->id)->TicketStatus;
            @endphp
            <x-modal.form wire:model.defer='modalEdit' maxWidth="5xl">
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
                        <div class="grid grid-cols-1 sm:grid-cols-8 gap-3">
                            <div class="m-4 col-span-1 sm:col-span-2">
                                <x-input-label for="subcategory_id" :value="__('Solicitante')"
                                               class="text-lg font-bold"/>
                                <x-select name='subcategory_id' wire:model.defer='editing.requester_id'
                                          id="subcategory_id" class="w-24 sm:w-full">
                                    <x-slot name='option'>
                                        @foreach($requesters as $requester)
                                            <x-select.option value="{{$requester->id}}">
                                                {{$requester->name}}
                                            </x-select.option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                                <x-input-error class="mt-2"
                                               :messages="$errors->get('editing.sub_category_id')"/>
                            </div>
                            <div class="m-4 col-span-1 sm:col-span-3">
                                <x-input-label for="category_id" :value="__('Selecionar Categoria')"
                                               class="text-lg font-bold"/>
                                <x-select name='category_id' wire:model='editing.category_id' id="category_id"
                                          class="w-24 sm:w-full">
                                    <x-slot name='option'>
                                        <option selected> Selecione</option>
                                        @foreach($categories as $category)
                                            <x-select.option value="{{$category->id}}">
                                                {{$category->name}}
                                            </x-select.option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                                <x-input-error class="mt-2" :messages="$errors->get('editing.category_id')"/>
                            </div>
                            @if(count($subcategories)>0)
                                <div class="m-4 col-span-1 sm:col-span-3">
                                    <x-input-label for="subcategory_id" :value="__('Selecionar Sub-Categoria')"
                                                   class="text-lg font-bold"/>
                                    <x-select name='subcategory_id' wire:model.defer='editing.sub_category_id'
                                              id="subcategory_id" class="w-24 sm:w-full">
                                        <x-slot name='option'>
                                            <option selected> Selecione</option>
                                            @foreach($subcategories as $subcategory)
                                                <x-select.option value="{{$subcategory->id}}">
                                                    {{$subcategory->name}}
                                                </x-select.option>
                                            @endforeach
                                        </x-slot>
                                    </x-select>
                                    <x-input-error class="mt-2"
                                                   :messages="$errors->get('editing.sub_category_id')"/>
                                </div>
                            @endif

                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-4">
                            <div class="m-4 col-span-1 sm:col-span-2">
                                <x-input-label for="ticket_open" :value="__('Data/Hora Abertura')"
                                               class="text-lg font-bold"/>
                                <x-text-input type='datetime-local' step="1"
                                              class="input input-bordered dark:bg-gray-900 dark:border-gray-50"
                                              name="ticket_open" id="ticket_open" wire:model.defer='editing.ticket_open'
                                              class="w-full"></x-text-input>
                                <x-input-error class="mt-2" :messages="$errors->get('editing.ticket_open')"/>
                            </div>
                            @isset($editing->ticket_start)
                                <div class="m-4 col-span-1 sm:col-span-2">
                                    <x-input-label for="ticket_start" :value="__('Data/Hora Inicio Atendimento')"
                                                   class="text-lg font-bold"/>
                                    <x-text-input type='datetime-local' step="1"
                                                  class="input input-bordered dark:bg-gray-900 dark:border-gray-50"
                                                  name="ticket_start" id="ticket_start"
                                                  wire:model.defer='editing.ticket_start'
                                                  class="w-full"></x-text-input>
                                    <x-input-error class="mt-2"
                                                   :messages="$errors->get('editing.ticket_start')"></x-input-error>
                                </div>
                            @endisset
                        </div>

                        <div class="m-4">
                            <x-input-label for="ticket_title" :value="__('Assunto')" class="text-lg font-bold"/>
                            <x-text-input type='text' name="ticket_title" id="ticket_title"
                                          wire:model.defer='editing.title'
                                          class="w-full"></x-text-input>
                            <x-input-error class="mt-2" :messages="$errors->get('editing.title')"/>
                        </div>
                        <div class="m-4">
                            <x-input-label for="ticket_description" :value="__('Mensagem')" class="text-lg font-bold"/>
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
                            <x-input-error class="mt-2" :messages="$errors->get('editing.description')"></x-input-error>
                        </div>
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
                    <p class="mb-4 text-sm font-light text-gray-500 dark:text-gray-100">As horas de trabalho serão
                        zeradas!
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
