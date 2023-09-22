<x-modal wire:model.defer='modalExams'>
    <div class="px-4 py-5 bg-white shadow sm:p-6">
        <div>
            <x-table>
                <x-slot name="head">
                    <x-table.heading>
                        Exame
                    </x-table.heading>
                    <x-table.heading>
                        Valor
                    </x-table.heading>
                    <x-table.heading>
                        Convênio
                    </x-table.heading>
                    <x-table.heading>
                        Ação
                    </x-table.heading>
                </x-slot>
                <x-slot name="body">

                    @isset($selectedExams)
                    @foreach($selectedExams as $key => $value)
                    <x-table.row class="hover:bg-gray-100">
                        <x-table.cell>
                            {{$value['exam_name']}}
                        </x-table.cell>
                        <x-table.cell>
                            R$ {{$value['exam_value']}}
                        </x-table.cell>
                        <x-table.cell>
                            @php
                            $convenio = \Modules\Orcamento\Entities\BudgetPlan::find($value['plan_id']);
                            @endphp
                            {{$convenio->name}}
                        </x-table.cell>
                        <x-table.cell>
                            <button type="button"
                                class="flex text-red-800 border border-red-800 rounded-lg hover:bg-red-800 hover:text-white"
                                wire:click="deselectExam({{$key}})">
                                <span>
                                    <x-icon name="minus" class="w-8 h-8 " solid></x-icon>
                                </span>
                            </button>
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                    @endisset


                </x-slot>
            </x-table>
        </div>
        <div
            class="flex items-center justify-end px-4 py-3 space-x-2 text-right shadow bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
            <x-danger-button wire:click='unsetCollection'>Remover todos</x-danger-button>
            <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
        </div>
    </div>
</x-modal>
<x-modal wire:model.defer='modalObservation'>
    <div>
        <x-title>Observação do orçamento</x-title>
    </div>
    <div class="pt-2">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
                <x-input-label for="observation" value="{{ __('Observação') }}" />
                <x-text-area name="observation" id="observation" type="text" wire:model='orcamento.observation'
                    placeholder="Escreva uma breve observação" class="block w-full mt-1"></x-text-area>
                @error('orcamento.observation')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div
        class="flex items-center justify-end px-4 py-3 space-x-2 shadow bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">

        <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>

    </div>
</x-modal>

<x-modal wire:model.defer='modalAlert' maxWidth='sm'>
    <div class="px-4 py-3">
        <x-title class="text-xl font-bold ">Atenção</x-title>
        <div>
            <p><span class="text-center text-gray-500 text-md">{{$convenio->description ?? ''}}</span></p>
        </div>
    </div>
    <div class="flex items-center justify-center px-4 py-3 space-x-2 sm:px-6">

        <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>

    </div>
</x-modal>