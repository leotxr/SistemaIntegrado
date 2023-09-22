<div class="p-4">
    <div class="pt-2">
        <form wire:submit.prevent="update">
            <div class="px-4 py-5 bg-white shadow dark:bg-gray-900 sm:p-6">
                <div class="grid grid-cols-7 gap-6">
                    <div class="col-span-6 sm:col-span-3" x-data>
                        <x-input-label for="patient_name" value="{{ __('Nome do Paciente') }}" />
                        <x-text-input name="patient_name" id="patient_name" type="text" class="block w-full mt-1 input"
                            wire:model.defer='orcamento.patient_name' readonly />
                        @error('orcamento.patient_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2" x-data>
                        <x-input-label for="born_date" value="{{ __('Data de Nascimento') }}" />
                        <x-text-input name="born_date" id="born_date" type="date" class="block w-full mt-1 input"
                            wire:model.defer='orcamento.patient_born_date' />
                        @error('orcamento.patient_born_date')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2" x-data>
                        <x-input-label for="phone_number" value="{{ __('Telefone de Contato') }}" />
                        <x-text-input name="phone_number" id="phone_number" type="text"
                            x-mask:dynamic="$input.startsWith('9', 4) ? '(99)99999-9999' : '(99)9999-9999'"
                            placeholder="(32)99999-9999" class="block w-full mt-1 input"
                            wire:model.defer='orcamento.patient_phone' readonly />
                        @error('orcamento.patient_phone')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2" x-data>
                        <x-input-label for="type" value="{{ __('Tipo') }}" />
                        <x-select id="type" name="type" wire:model='orcamento.budget_type_id'
                            class="block w-full mt-1 input">
                            <x-slot name="option">
                                <option selected disabled>
                                    Selecione
                                </option>
                                @foreach($types as $type)
                                <x-select.option value="{{$type->id}}">
                                    {{$type->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        @error('orcamento.budget_type_id')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2" x-data>
                        <x-input-label for="status" value="{{ __('Status') }}" />
                        <x-select id="status" name="status" wire:model='orcamento.budget_status_id'
                            class="block w-full mt-1 input">
                            <x-slot name="option">
                                <x-select.option selected disabled value="">
                                    Selecione
                                </x-select.option>
                                @foreach($statuses as $status)
                                <x-select.option value="{{$status->id}}">
                                    {{$status->name}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        @error('status')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-1">
                        <x-input-label value="{{ __('Total') }}" />
                        <span id="total" class="text-xl font-bold text-gray-600">R$ {{$orcamento->total_value}} </span>
                    </div>
                    <div class="col-span-6 sm:col-span-1">
                        <x-input-label value="{{ __('Quantidade') }}" />
                        <span id="quantidade"
                            class="text-xl font-bold text-gray-600">{{$orcamento->relExams->count()}}</span>
                    </div>

                </div>
            </div>
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
                    </x-slot>
                    <x-slot name="body">
                        @foreach($orcamento->relExams as $exam)
                        @php
                        $convenio = $exam->find($exam->id)->ExamPlan;
                        @endphp
                        <x-table.row class="hover:bg-gray-100">
                            <x-table.cell>
                                {{$exam->name}}
                            </x-table.cell>
                            <x-table.cell>
                                R$ {{$exam->value}}
                            </x-table.cell>
                            <x-table.cell>
                                {{$convenio->name}}
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
            <div
                class="grid max-w-full grid-cols-2 px-4 py-3 space-x-2 shadow justify-items-stretch bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                <div class="justify-self-start ">
                    <x-secondary-button type="button" class="flex text-yellow-300"
                        wire:click="$set('modalObservation', true)">
                        @if($orcamento->observation)
                        <span class="relative flex">
                            <span
                                class="absolute inline-flex w-full h-full bg-yellow-400 rounded-full opacity-75 animate-ping"></span><span
                                class="relative ">
                                <x-icon name="bell" class="w-4 h-4 " />
                            </span>
                        </span>
                        @endif
                        <span class="text-gray-900">Observações</span>
                    </x-secondary-button>
                </div>

                <div class="space-x-2 justify-self-end">
                    <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
            </div>

        </form>
    </div>
    {{--
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

    --}}

    @include('orcamento::util.modals-budget')
    
</div>