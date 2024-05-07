<div>
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>

    <div class="text-gray-800 dark:text-gray-100">
        <div class="w-full bg-white dark:bg-gray-800 p-2 grid sm:grid-cols-6 grid-cols-2 gap-4">
            <div class="col-span-2 sm:col-span-2">
                <x-input-label for="book">Médico</x-input-label>
                <x-select id="book" class="w-full" wire:model.defer="selected_doctor">
                    <x-slot name="option">
                        <x-select.option value="0">Selecione o médico</x-select.option>
                        @foreach($doctors as $doctor)
                            <x-select.option value="{{$doctor->id}}">{{$doctor->name}}</x-select.option>
                        @endforeach
                    </x-slot>
                </x-select>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <x-input-label for="start_date">Data Inicial</x-input-label>
                <x-text-input type="date" id="start_date" wire:model.defer="start_date"
                              class="w-full"></x-text-input>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <x-input-label for="end_date">Data Final</x-input-label>
                <x-text-input type="date" id="end_date" wire:model.defer="end_date"
                              class="w-full"></x-text-input>
            </div>
            <div class="col-span-2 sm:col-span-1 p-4">
                <x-primary-button type="button" wire:click="$refresh">Buscar</x-primary-button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-4 sm:grid-cols-4 gap-2">
        <x-dashboard-container class="sm:max-h-52 max-h-60" colspan="sm:col-span-3 col-span-4">
            <x-slot:title>Faturas do período</x-slot:title>
            <x-slot:description>Mostra as faturas do período e médico selecionado</x-slot:description>
            <x-slot:content>
                <x-table>
                    <x-slot:head>
                        <x-table.heading>Data Exame</x-table.heading>
                        <x-table.heading>Fatura</x-table.heading>
                        <x-table.heading>Paciente</x-table.heading>
                        <x-table.heading>Exame</x-table.heading>
                        <x-table.heading>Médico</x-table.heading>
                        <x-table.heading>Valor Total</x-table.heading>
                    </x-slot:head>
                    <x-slot:body>
                        @foreach($invoices as $invoice)
                            <x-table.row class="text-xs">
                                <x-table.cell>{{$invoice->exam_date}}</x-table.cell>
                                <x-table.cell>{{$invoice->invoice_id}}</x-table.cell>
                                <x-table.cell>{{$invoice->patient_name}}</x-table.cell>
                                <x-table.cell>{{$invoice->exam_description}}</x-table.cell>
                                <x-table.cell>{{$invoice->doctor}}</x-table.cell>
                                <x-table.cell>{{$invoice->total_value}}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot:body>
                </x-table>
            </x-slot:content>
        </x-dashboard-container>
        <x-dashboard-container colspan="sm:col-span-1 col-span-4">
            <x-slot:title>Total de Faturas</x-slot:title>
            <x-slot:description>Mostra o total de faturas buscadas à partir do filtro</x-slot:description>
            <x-slot:content>
                <div class="text-center grid content-center">
                    <span class="text-5xl text-gray-600 dark:text-gray-200">{{$invoices->count()}}</span>
                </div>
            </x-slot:content>
        </x-dashboard-container>
    </div>

</div>