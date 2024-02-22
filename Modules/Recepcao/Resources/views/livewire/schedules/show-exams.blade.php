<div>
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>
    <x-modal.dialog wire:model.defer="modalExams">
        <x-slot:title>
            Exames Anteriores
        </x-slot:title>
        <x-slot:content>
            @isset($patient_exams)
                <x-table>
                    <x-slot:head>
                        <x-table.heading>Data</x-table.heading>
                        <x-table.heading>Fatura</x-table.heading>
                        <x-table.heading>Exame</x-table.heading>
                        <x-table.heading>Laudo</x-table.heading>
                    </x-slot:head>
                    <x-slot:body>
                        @foreach($patient_exams as $exam)
                            <x-table.row>
                                <x-table.cell>{{date('d/m/Y', strtotime($exam->DATA))}}</x-table.cell>
                                <x-table.cell>{{$exam->FATURAID}}</x-table.cell>
                                <x-table.cell>{{$exam->LAUDONOMEEXAME}}</x-table.cell>
                                <x-table.cell><a type="button" class="cursor-pointer"
                                                 wire:click="getReport({{$exam->FATURAID}}, {{$exam->PACIENTEID}})">
                                        <x-icon name="eye" class="w-6 h-6"></x-icon>
                                    </a></x-table.cell>
                            </x-table.row>
                        @endforeach

                    </x-slot:body>
                </x-table>
            @endisset
        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </div>
        </x-slot:footer>
    </x-modal.dialog>
    @livewire('recepcao::schedules.show-report')

</div>
