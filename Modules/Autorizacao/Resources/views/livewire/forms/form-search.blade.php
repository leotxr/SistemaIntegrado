<div>
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>
    <div class="shadow sm:overflow-hidden sm:rounded-md ">
        <div class="content-center px-4 py-5 space-y-6 bg-white sm:p-6">
            <div class="content-center gap-4">
                <form wire:submit.prevent="search">

                    <div class="mt-1">
                        <x-input-label for="protocol" class="block text-sm font-medium text-gray-700">Protocolo
                        </x-input-label>
                        <x-text-input type="number" id="protocol" wire:model.defer='protocol_search' required
                                      class="w-full max-w-xs"/>
                    </div>
                    <div class="flex" x-data="{disabled: true }">
                        <x-primary-button type="submit" class="mt-2" id="get_protocol" :disabled="!$formProtocol">
                            Consultar
                            Protocolo
                        </x-primary-button>
                        <div class="flex mx-2 mt-4">
                            <x-text-input type="checkbox" class="mx-2 checkbox" id="checkbox" name="checkbox"
                                          wire:click="$toggle('formProtocol')"/>
                            <x-input-label for="checkbox" :value="__('Solicitação sem protocolo')"/>
                        </div>
                    </div>
                </form>
            </div>

            <div>

                <form wire:submit.prevent="save" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                        <div class="mt-4">
                            <x-input-label for="paciente_id" :value="__('Código do Paciente')"/>
                            <x-text-input type="number" name='paciente_id' id="paciente_id" class="w-xs"
                                          wire:model.defer="protocol.paciente_id"
                            ></x-text-input>
                            <x-input-error class="mt-2" :messages="$errors->get('data.patient_id')"/>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nome do Paciente')"/>
                            <x-text-input type="text" name='name' id="name" class="w-full"
                                          wire:model.defer="protocol.paciente_name"
                                          required></x-text-input>
                            <x-input-error class="mt-2" :messages="$errors->get('data.patient_name')"/>
                        </div>
                    </div>
                    @if($formProtocol)
                        <x-accordion>
                            <x-slot name='title'>
                                Exames do Protocolo {{$protocol_search}}
                            </x-slot>
                            <x-slot name='content'>
                                @foreach($exams as $exam)
                                    <div
                                        class="grid grid-cols-2 sm:grid-cols-4 gap-2 p-2 mt-4 border rounded-lg shadow-sm">
                                        <div class="mt-4 col-span-2 sm:col-span-2">
                                            <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Código Procedimento
                                            </dt>
                                            <dd class="dark:bg-gray-900 dark:text-gray-300">{{$exam->exam_cod ?? $exam['exam_cod']}}</dd>
                                        </div>

                                        <div class="mt-4 col-span-2 sm:col-span-2">
                                            <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Procedimento
                                            </dt>
                                            <dd class="dark:bg-gray-900 dark:text-gray-300">{{$exam->name ?? $exam['name']}}</dd>
                                        </div>

                                        <div class="mt-4 col-span-2 sm:col-span-2">
                                            <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Data
                                            </dt>
                                            <dd class="dark:bg-gray-900 dark:text-gray-300">{{$exam->exam_date ?? $exam['exam_date']}}</dd>
                                        </div>

                                        <div class="mt-4 col-span-2 sm:col-span-2">
                                            <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                                Convênio
                                            </dt>
                                            <dd class="dark:bg-gray-900 dark:text-gray-300">{{$exam->convenio ?? $exam['convenio']}}</dd>
                                        </div>
                                    </div>
                                @endforeach
                            </x-slot>
                        </x-accordion>
                    @else
                        <x-accordion>
                            <x-slot name='title'>
                                Cadastrar exames
                            </x-slot>
                            <x-slot name='content'>
                                <div class="p-2 mt-4 border">
                                    @foreach($inputs as $key => $input)
                                        <div class="mt-4">
                                            <x-input-label for="exam" :value="__('Procedimento')"/>
                                            <x-text-input type="text" name='exam[]' class="w-full"
                                                          wire:model.defer="exam.{{$key}}.name"
                                                          value=""></x-text-input>
                                            <x-input-error class="mt-2" :messages="$errors->get('data.exam')"/>
                                        </div>

                                        <div class="grid grid-cols-2 gap-2">

                                            <div class="mt-4">
                                                <x-input-label for="exam_date" :value="__('Data')"/>
                                                <x-text-input type="date" name='exam_date[]' class="w-sm" value=""
                                                              wire:model.defer="exam.{{$key}}.exam_date">
                                                </x-text-input>
                                                <x-input-error class="mt-2" :messages="$errors->get('data.exam_date')"/>
                                            </div>

                                            <div class="mt-4">
                                                <x-input-label for="exam_conv" :value="__('Convênio')"/>
                                                <x-text-input type="text" name='exam_conv[]' class="w-sm" value=""
                                                              wire:model.defer="exam.{{$key}}.convenio">
                                                </x-text-input>
                                                <x-input-error class="mt-2" :messages="$errors->get('data.exam_conv')"/>
                                            </div>
                                        </div>

                                        @if($key > 0)
                                            <div wire:click="removeInput({{$key}})"
                                                 class="flex items-center justify-end w-full text-sm text-red-600 cursor-pointer">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                                <p>Remover Procedimento</p>
                                            </div>
                                        @endif

                                    @endforeach
                                    <div wire:click="addInput"
                                         class="flex items-center justify-center w-full py-4 text-sm text-blue-600 cursor-pointer">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="ml-2">Adicionar Procedimento</p>
                                    </div>
                                </div>

                            </x-slot>
                        </x-accordion>
                    @endif
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                         x-on:livewire-upload-finish="isUploading = false"
                         x-on:livewire-upload-error="isUploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Anexar arquivos</label>
                            <div
                                class="flex justify-center px-6 pt-5 pb-6 mt-1 border-2 border-gray-300 border-dashed rounded-md">
                                <input type="file" name="photo[]" id="photo" wire:model='photos'
                                       class="w-full max-w-xs file-input file-input-bordered" multiple/>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700"
                                 x-show="isUploading">
                                <div class="bg-blue-600 h-1.5 rounded-full dark:bg-blue-500" min="0" max="100"
                                     x-bind:style="`width:${progress}%`"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 py-4 sm:grid-cols-4">
                            @if ($photos)
                                <label class="block text-sm font-medium text-gray-700">Fotos Anexadas</label>
                                @foreach($photos as $photo)
                                    <div>
                                        <a href="{{ $photo->temporaryUrl() }}" target="_blank()">
                                            <img class="w-16 max-h-16" src="{{ $photo->temporaryUrl() }}">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-input-label for="observacao" :value="__('Observação')"/>
                            <x-text-area type="text" name='observation' id="observacao"
                                         wire:model.defer="protocol.observacao"></x-text-area>
                            <x-input-error class="mt-2" :messages="$errors->get('protocol.observacao')"/>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <x-primary-button type="submit" class="mt-2">Enviar</x-primary-button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
