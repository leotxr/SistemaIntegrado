<div>
    <div class="shadow sm:overflow-hidden sm:rounded-md ">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6 content-center">
            <div class="gap-4 content-center">
                <form wire:submit.prevent="render">

                    <label for="protocol" class="block text-sm font-medium text-gray-700">Protocolo</label>
                    <div class="mt-1">
                        <x-text-input type="text" id="protocol" wire:model.defer='protocol' required
                            class="w-full max-w-xs" />
                    </div>
                    <div class="flex">
                        <x-primary-button type="submit" class="mt-2" id="get_protocol">Consultar
                            Protocolo</x-primary-button>
                        <div class="mx-2 mt-4 flex">
                            <input type="checkbox" class="checkbox mx-2" id="checkbox"
                                wire:click="$toggle('formProtocol')" />
                            <x-input-label for="checkbox" :value="__('Solicitação sem protocolo')" />
                        </div>
                    </div>
                </form>

            </div>

            <div wire:loading>
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
                        <span class="sr-only">Carregando informações...</span>
                    </div>
                </div>
            </div>

            <div>

                <form action="{{route('autorizacao.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid sm:grid-cols-2 grid-cols-1 gap-2">
                        <div class="mt-4">
                            <x-input-label for="pacientid" :value="__('Código do Paciente')" />
                            <x-text-input type="text" name='pacienteid' class="w-xs"
                                value="{{$show_data_patient->PACIENTEID}}"></x-text-input>
                            <x-input-error class="mt-2" :messages="$errors->get('data.patient_id')" />
                        </div>
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nome do Paciente')" />
                            <x-text-input type="text" name='name' class="w-full"
                                value="{{$show_data_patient->NOMEPAC}}"></x-text-input>
                            <x-input-error class="mt-2" :messages="$errors->get('data.patient_name')" />
                        </div>
                    </div>
                    @if($formProtocol == true)
                    <x-accordion>
                        <x-slot name='title'>
                            Exames do Protocolo {{$protocol}}
                        </x-slot>
                        <x-slot name='content'>
                            @foreach($show_data_protocol as $data)
                            <div class="grid grid-cols-2 gap-2 mt-4 border p-2">
                                <div class="mt-4">
                                    <x-input-label for="exam_cod" :value="__('Código Procedimento')" />
                                    @if ($data->CONVENIOID == 4)
                                    <x-text-input type="text" name='exam_cod[]' class="w-sm" value="{{$data->CODIGO}}">
                                    </x-text-input>
                                    @else
                                    <x-text-input type="text" name='exam_cod[]' class="w-sm" value="{{$data->CODTUSS}}">
                                    </x-text-input>
                                    @endif
                                    <x-input-error class="mt-2" :messages="$errors->get('data.exam_cod')" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="exam" :value="__('Procedimento')" />
                                    <x-text-input type="text" name='exam[]' class="w-full"
                                        value="{{$data->NOME_PROCEDIMENTO}}"></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('data.exam')" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="exam_date" :value="__('Data')" />
                                    <x-text-input type="text" name='exam_date[]' class="w-sm" value="{{$data->DATA}}">
                                    </x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('data.exam_date')" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="exam_conv" :value="__('Convênio')" />
                                    <x-text-input type="text" name='exam_conv[]' class="w-sm"
                                        value="{{$data->CONVDESC}}">
                                    </x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('data.exam_conv')" />
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
                            <div class="mt-4 border p-2">
                                @foreach($inputs as $key => $input)
                                <div class="mt-4">
                                    <x-input-label for="exam" :value="__('Procedimento')" />
                                    <x-text-input type="text" name='exam[]' class="w-full" value=""></x-text-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('data.exam')" />
                                </div>

                                <div class="grid grid-cols-2 gap-2">

                                    <div class="mt-4">
                                        <x-input-label for="exam_date" :value="__('Data')" />
                                        <x-text-input type="date" name='exam_date[]' class="w-sm" value="">
                                        </x-text-input>
                                        <x-input-error class="mt-2" :messages="$errors->get('data.exam_date')" />
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="exam_conv" :value="__('Convênio')" />
                                        <x-text-input type="text" name='exam_conv[]' class="w-sm" value="">
                                        </x-text-input>
                                        <x-input-error class="mt-2" :messages="$errors->get('data.exam_conv')" />
                                    </div>
                                </div>

                                @if($key > 0)
                                <div wire:click="removeInput({{$key}})"
                                    class="flex items-center justify-end text-red-600 text-sm w-full cursor-pointer">
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
                                    class="flex items-center justify-center text-blue-600 text-sm py-4 w-full cursor-pointer">
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

                    <div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Anexar arquivos</label>
                            <div
                                class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                <input type="file" name="photo[]" id="photo" wire:model='photo'
                                    class="file-input file-input-bordered w-full max-w-xs" multiple />
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-4 grid-cols-2 gap-2 py-4">
                            @if ($photo)
                            <label class="block text-sm font-medium text-gray-700">Fotos Anexadas</label>
                            @foreach($photo as $photos)
                            <div>
                                <a href="{{ $photos->temporaryUrl() }}" target="_blank()">
                                    <img class="w-16 max-h-16" src="{{ $photos->temporaryUrl() }}">
                                </a>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-input-label for="observacao" :value="__('Observação')" />
                            <x-text-area type="text" name='observation' id="observacao" value=""></x-text-area>
                            <x-input-error class="mt-2" :messages="$errors->get('data.observation')" />
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <x-primary-button type="submit" class="mt-2">Enviar</x-primary-button>
                    </div>
                </form>
            </div>



        </div>

    </div>
</div>