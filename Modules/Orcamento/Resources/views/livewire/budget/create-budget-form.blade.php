<div class="p-4">
    <div class="pt-2">
        <form wire:submit.prevent="save">
            <div class="px-4 py-5 bg-white shadow sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4" x-data>
                        <x-input-label for="patient_name" value="{{ __('Nome do Paciente') }}" />
                        <x-text-input name="patient_name" id="patient_name" type="text" placeholder="José da Silva"
                            class="block w-full mt-1 input" wire:model.defer='orcamento.patient_name' autofocus />
                        @error('orcamento.patient_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2" x-data>
                        <x-input-label for="born_date" value="{{ __('Data de Nascimento') }}" />
                        <x-text-input name="born_date" id="born_date" type="date"
                             class="block w-full mt-1 input" wire:model.defer='orcamento.patient_born_date' />
                        @error('orcamento.patient_born_date')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-3" x-data>
                        <x-input-label for="phone_number" value="{{ __('Telefone de Contato') }}" />
                        <x-text-input name="phone_number" id="phone_number" type="text"
                            x-mask:dynamic="$input.startsWith('9', 4) ? '(99)99999-9999' : '(99)9999-9999'"
                            placeholder="(32)99999-9999" class="block w-full mt-1 input" wire:model.defer='orcamento.patient_phone' />
                        @error('orcamento.patient_phone')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-3" x-data>
                        <x-input-label for="plan" value="{{ __('Convênio') }}" />
                        <x-select id="plan" name="plan" wire:model='plan' class="block w-full mt-1 input">
                            <x-slot name="option">
                                <x-select.option selected disabled value="">
                                    Selecione
                                </x-select.option>
                                @foreach($plans as $conv)
                                <x-select.option value="{{$conv->id}}">
                                    {{$conv->description}}
                                </x-select.option>
                                @endforeach
                            </x-slot>
                        </x-select>
                        @error('plan')
                        <span class="error">{{ $message }}</span>
                        @enderror
                        {{$convenio}}
                    </div>
                    <div class="col-span-6 sm:col-span-3" x-data>
                        <x-input-label for="search_exam" value="{{ __('Pesquisar') }}" />
                        <x-text-input name="search_exam" id="search_exam" type="text" wire:model='search'
                            class="block w-full mt-1 input" />
                        @error('search_exam')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-1">
                        <x-input-label value="{{ __('Total') }}" />
                        <span id="total" class="text-xl font-bold text-gray-600">R$ {{$total}}</span>
                    </div>
                    <div class="col-span-6 sm:col-span-1">
                        <x-input-label value="{{ __('Quantidade') }}" />
                        <span id="quantidade" class="text-xl font-bold text-gray-600"
                            wire:click='showSelectedExams'>{{$selectedExams->count()}}</span>
                    </div>
                    @if($selectedExams->count() > 0)
                    <div class="col-span-6 sm:col-span-1">
                        <button type="button"
                            class="p-2 text-xl text-green-800 border border-green-800 rounded-lg hover:bg-green-800 hover:text-white"
                            wire:click='showSelectedExams'>Ver
                            exames</button>
                    </div>
                    @endif

                </div>
            </div>
            <div>
                <div wire:loading wire:target='render'>
                    Carregando...
                </div>
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>
                            Exame
                        </x-table.heading>
                        <x-table.heading>
                            Valor
                        </x-table.heading>
                        <x-table.heading>
                            Ação
                        </x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($exams as $exam)
                        <x-table.row class="hover:bg-gray-100">
                            <x-table.cell>
                                {{$exam->DESCRICAO}}
                            </x-table.cell>
                            <x-table.cell>
                                {{$exam->QUANTCH}}
                            </x-table.cell>
                            <x-table.cell>
                                <button type="button"
                                    class="flex text-green-800 border border-green-800 rounded-lg hover:bg-green-800 hover:text-white"
                                    wire:click="selectExam('{{$exam->DESCRICAO}}', {{$exam->QUANTCH}}, {{$plan}})">
                                    <span>
                                        <x-icon name="plus" class="w-8 h-8 " solid></x-icon>
                                    </span>
                                </button>
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
            <div
                class="flex items-center justify-end px-4 py-3 space-x-2 text-right shadow bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                <x-secondary-button x-on:click="$dispatch('close')">Cancelar</x-secondary-button>
                <x-primary-button type="submit">Salvar</x-primary-button>
            </div>

        </form>
    </div>
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
                            Ação
                        </x-table.heading>
                    </x-slot>
                    <x-slot name="body">

                        @if($selectedExams)
                        @foreach($selectedExams as $key => $value)
                        <x-table.row class="hover:bg-gray-100">
                            <x-table.cell>
                                {{$value['exam_name']}}
                            </x-table.cell>
                            <x-table.cell>
                                {{$value['exam_value']}}
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
                        @endif


                    </x-slot>
                </x-table>
            </div>
            <div class="grid grid-cols-6 gap-6">

            </div>
            <div
                class="flex items-center justify-end px-4 py-3 space-x-2 text-right shadow bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                <x-danger-button wire:click='unsetCollection'>Remover todos</x-danger-button>
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </div>
        </div>
    </x-modal>
</div>