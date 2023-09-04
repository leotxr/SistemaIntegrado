<div class="p-4">
    <div class="pt-2">
        <form wire:submit.prevent="save">
            <div class="px-4 py-5 bg-white shadow sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4" x-data>
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
                            wire:model.defer='orcamento.patient_born_date' readonly />
                        @error('orcamento.patient_born_date')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-3" x-data>
                        <x-input-label for="phone_number" value="{{ __('Telefone de Contato') }}" />
                        <x-text-input name="phone_number" id="phone_number" type="text"
                            x-mask:dynamic="$input.startsWith('9', 4) ? '(99)99999-9999' : '(99)9999-9999'"
                            placeholder="(32)99999-9999" class="block w-full mt-1 input"
                            wire:model.defer='orcamento.patient_phone' readonly />
                        @error('orcamento.patient_phone')
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

                    <div class="col-span-6 sm:col-span-1">
                        @if($orcamento->scheduled === 0)

                        <button type="button"
                            class="p-2 text-green-800 border border-green-800 rounded-lg text-md hover:bg-green-800 hover:text-white"
                            wire:click='markScheduled({{$orcamento->id}})'>Marcar como Agendado</button>
                        @else
                        <button type="button"
                            class="p-2 text-white bg-green-800 border border-green-800 rounded-lg text-md hover:bg-white hover:text-red-800 hover:border-red-800" 
                            wire:click='markScheduled({{$orcamento->id}})'>Agendado</button>
                        @endif
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
                                {{$convenio->description}}
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
            <div
                class="flex items-center justify-end px-4 py-3 space-x-2 text-right shadow bg-gray-50 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </div>

        </form>
    </div>
</div>