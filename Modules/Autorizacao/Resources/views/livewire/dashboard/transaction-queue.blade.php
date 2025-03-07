<div class="space-y-2">
    <div class="grid justify-items-center grid-cols-2 sm:grid-cols-10 gap-2" x-data>
        @foreach($events as $event)
            <div :class="{'scale-95 dark:bg-gray-500 bg-gray-300' : {{$selected_status}} === {{$event['id']}}}"
                 class="rounded-lg shadow-md stat max-h-auto hover:scale-95 col-span-2 sm:col-span-2 dark:bg-gray-800 bg-white transition transform duration-300"
                 wire:click="selectStatus({{$event['id']}})">
                <div class="font-bold text-gray-800 dark:text-gray-50">{{$event['name']}}</div>
                <div class="inline-flex justify-between">
                    <div>
                        <x-icon name="{{$event['icon']}}" class="w-6 h-6 text-blue-600"></x-icon>
                    </div>
                    <div class="text-gray-800 dark:text-gray-50 text-2xl">{{$event['count']}}</div>
                </div>
            </div>
        @endforeach
        @php print_r($selected_status); @endphp
    </div>
    <div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm w-full h-sm p-2">
            <div class="w-full flex justify-between items-center">
                <div class="text-gray-600 dark:text-gray-100">
                    @isset($selected_exams)
                        {{count($selected_exams)}} Exames selecionados.
                    @endisset
                </div>
                <div class="">
                    @if($selected_status == 5)
                        <x-primary-button wire:click="sendTo(3)" class="cursor-pointer">Enviar para Autorização
                        </x-primary-button>
                    @elseif($selected_status == 3)
                        <x-primary-button wire:click="sendTo(1)" class="cursor-pointer">Receber na Autorização
                        </x-primary-button>
                    @elseif($selected_status == 1)
                        <x-primary-button wire:click="sendTo(4)" class="cursor-pointer">Enviar para Recepção
                        </x-primary-button>
                    @else
                        <x-primary-button wire:click="sendTo(2)" class="cursor-pointer">Receber na Recepção
                        </x-primary-button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="mt-4">
            <x-text-input type="text" wire:model='search' placeholder="Buscar solicitações...">
            </x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('exam.exam')"/>
        </div>
        <div>
            <x-title>Mostrando resultados para: <span
                        class="font-semibold text-lg">{{$selected_event_show->name}}</span></x-title>
        </div>
        <x-table>
            <x-slot name="head">
                <x-table.heading><input type="checkbox" wire:model="selectAllExams"/></x-table.heading>
                <x-table.heading sortable wire:click="sortBy('exams.id')" :direction="$sort_field === 'exams.id' ? $sort_direction : null">ID</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('exams.exam_date')" :direction="$sort_field === 'exams.exam_date' ? $sort_direction : null">Data Exame</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('protocols.paciente_name')" :direction="$sort_field === 'protocols.paciente_name' ? $sort_direction : null">Paciente</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('exams.name')" :direction="$sort_field === 'exams.name' ? $sort_direction : null">Procedimento</x-table.heading>
                <x-table.heading sortable wire:click="sortBy('exam_statuses.name')" :direction="$sort_field === 'exam_statuses.name' ? $sort_direction : null">Status</x-table.heading>
                <x-table.heading>Envio único</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($exams as $exam)
                    @php
                        $exam_event = $exam->find($exam->exam_id)->events()->first();
                    @endphp
                    <x-table.row>
                        <x-table.cell>
                            <input id="exams-{{$exam->exam_id}}" type="checkbox"
                                   value="{{$exam->exam_id}}"
                                   wire:model="selected_exams" name="exams[]"
                                   class="w-4 h-4"/>
                        </x-table.cell>
                        <x-table.cell>{{$exam->exam_id}}</x-table.cell>
                        <x-table.cell>{{date('d/m/y', strtotime($exam->exam_date))}}</x-table.cell>
                        <x-table.cell>{{$exam->paciente_name}}</x-table.cell>
                        <x-table.cell>{{$exam->exam_name}}</x-table.cell>
                        <x-table.cell>{{$exam->status_name}}</x-table.cell>
                        <x-table.cell>

                            <x-secondary-button wire:click="$emit('newTransaction', {{$exam->exam_id}})"
                                                class="text-xs">
                                <span>Alterar</span>
                                <x-icon name="switch-horizontal"
                                        class="w-5 h-5 text-gray-600 dark:text-gray-100"></x-icon>
                            </x-secondary-button>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
        {{$exams->links()}}
    </div>
    @livewire('autorizacao::requests.transactions.new-transaction')
</div>