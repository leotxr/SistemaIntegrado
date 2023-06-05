@isset($editing)

<x-modal.form wire:model.defer="modalExam">
    <x-slot name='title'>
        Editar Protocolo
    </x-slot>
    <x-slot name="content">

        @foreach($editing as $index => $exam)
        @if(auth()->user()->cant('editar autorizacao')) @php $isDisabled = true; @endphp @endif
        @php
        $protocol = $exam->find($exam->id)->relProtocolExam;
        $solicitante = $protocol->find($protocol->id)->relUserProtocol;
        $exam_status = $exam->find($exam->exam_status_id)->relExamStatus;
        @endphp
        <div wire:key="exam-field-{{$exam->id}}" class="border-2 rounded-md border-gray-300 p-4 mb-2">
            <div class="grid grid-cols-2 sm:grid-cols-3 divide-x gap-1 border-b">
                <div>
                    <div class="mt-2">
                        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Paciente</dt>
                        <dd class="text-sm font-semibold">{{$protocol->paciente_name}}</dd>
                    </div>
                </div>
                <div>
                    <div class="mt-2">
                        <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Data da Solicitação</dt>
                        <dd class="text-sm font-semibold">{{$exam->created_at->format('d/m/Y H:i:s ')}}</dd>
                    </div>
                </div>
                <div>
                    <div class="mt-2">
                        <div class="mt-2">
                            <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Usuário Solicitante</dt>
                            <dd class="text-sm font-semibold">{{$solicitante->name}}</dd>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-1 mx-2">
                <div>
                    <div class="mt-4">
                        <x-input-label for="exam_cod" :value="__('Código')" />
                        <x-text-input type="text" disabled='{{$isDisabled}}' name='exam_cod'
                            value="{{$exam->exam_cod}}" id='exam_cod' class="w-36">
                        </x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('exam.exam_cod')" />
                    </div>
                </div>
                <div>
                    <div class="mt-4">
                        <x-input-label for="exam" :value="__('Procedimento')" />
                        <x-text-input type="text" name='exam' disabled='{{$isDisabled}}' value="{{$exam->name}}"
                            id='exam' class="w-full">
                        </x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('exam.exam')" />
                    </div>
                </div>

                <div>
                    <div class="mt-4">
                        <x-input-label for="exam_date" :value="__('Data do exame')" />
                        <x-text-input type="date" name='exam_date' disabled='{{$isDisabled}}' class="w-xs"
                            id="exam_date" value="{{$exam->exam_date}}">
                        </x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('exam.exam_date')" />
                    </div>
                </div>
                <div>
                    <div class="mt-4">
                        <x-input-label for="convenio" :value="__('Convênio')" />
                        <x-text-input type="text" name='convenio' disabled='{{$isDisabled}}' class="w-full"
                            id="convenio" value="{{$exam->convenio}}">
                        </x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('exam.convenio')" />
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="mt-4">
                        <x-input-label for="status" :value="__('Status')" />
                        <x-select id="exam_status" name="exam_status" autocomplete="exam_status"
                            wire:model='editing.{{$index}}.exam_status_id' disabled='{{$isDisabled}}'>
                            <x-slot name='option'>
                                @foreach($statuses as $status)
                                <x-select.option value="{{ $status->id }}">
                                    {{ $status->name }}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        <x-input-error class="mt-2" :messages="$errors->get('exam.status')" />
                    </div>
                    <div class="mt-4">

                    </div>
                </div>
            </div>
            <div>
                <div class="mt-4">
                    <x-input-label for="observacao" :value="__('Observação do Exame')" />
                    <x-text-area id="observacao" wire:model='editing.{{$index}}.exam_obs' disabled='{{$isDisabled}}'
                        name="observacao" value="{{$exam->exam_obs}}"></x-text-area>
                </div>
            </div>
        </div>
        @endforeach
    </x-slot>
    <x-slot name='subcontent'>
        @foreach($protocol->relPhotos as $photos)

        <div class="flex space-x-2 mx-2">
            <a href="{{URL::asset($photos->url)}}" target="_blank()">
                <img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                    src="{{URL::asset($photos->url)}}" alt="Bordered photo">
            </a>
        </div>

        @endforeach
    </x-slot>
    <x-slot name='footer'>

        <div class="flex">
            @can(['editar autorizacao', 'excluir autorizacao'])
            <div class="flex items-center">
                <input id="recebida" type="checkbox" wire:model='editing_protocol.recebido'
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="recebida" class="ml-2 text-sm font-bold text-gray-900 dark:text-gray-300">Marcar como
                    recebida</label>
            </div>
            <x-danger-button wire:click='confirmDelete({{$protocol->id}})' class="mx-4">Excluir
            </x-danger-button>
            <x-secondary-button x-on:click="$dispatch('close')" class="mx-4">Fechar</x-secondary-button>
            <x-primary-button wire:click='save' class="mx-4">Salvar</x-primary-button>
            @else
            <x-secondary-button x-on:click="$dispatch('close')" class="mx-4">Fechar</x-secondary-button>
            <x-primary-button wire:click='save' disabled='{{$isDisabled}}' class="mx-4">Salvar</x-primary-button>
            @endcan

        </div>

    </x-slot>
</x-modal.form>



<x-modal.confirmation wire:model.defer='modalDelete'>
    <x-slot name='dialog'>
        Tem certeza que deseja Excluir este registro?
    </x-slot>
    <x-slot name='buttons'>
        <x-secondary-button x-on:click="$dispatch('close')" class="mx-4">Cancelar</x-secondary-button>
        <x-danger-button wire:click='delete({{$protocol->id}})' class="mx-4">Sim, Excluir</x-danger-button>
    </x-slot>
</x-modal.confirmation>

@endisset
