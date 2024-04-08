<div>
    <div class="p-2 grid justify-items-end">
        <x-primary-button type="button">
            <a class="flex" href="{{route('administrativo.financial.invoices.create')}}">
                <x-icon name="plus" class="w-5 h-5 text-white"></x-icon>
                <span> Novo exame</span>
            </a>
        </x-primary-button>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-6 gap-2">
        <div class="col-span-2 sm:col-span-4 rounded-lg" >
            <x-dashboard-container height="lg">
                <x-slot:title>Últimas importações</x-slot:title>
                <x-slot:description>Mostra os 5 últimos exames importados.</x-slot:description>
                <x-slot:content>
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>Data Exame</x-table.heading>
                            <x-table.heading>Fatura</x-table.heading>
                            <x-table.heading>Nome Paciente</x-table.heading>
                            <x-table.heading>Exame</x-table.heading>
                            <x-table.heading>Valor Total</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($invoices as $invoice)
                                <x-table.row class="text-xs">
                                    <x-table.cell>{{date('d/m/y', strtotime($invoice->exam_date))}}</x-table.cell>
                                    <x-table.cell>{{$invoice->invoice_id}}</x-table.cell>
                                    <x-table.cell>{{$invoice->patient_name}}</x-table.cell>
                                    <x-table.cell>{{$invoice->exam_description}}</x-table.cell>
                                    <x-table.cell>R$ {{$invoice->total_value}}</x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                </x-slot:content>
            </x-dashboard-container>
        </div>
        <div class="col-span-2 sm:col-span-2">
            <x-dashboard-container>
                <x-slot:title>Exames este mês</x-slot:title>
                <x-slot:description>Até o momento este é o total de exames incluídos este mês</x-slot:description>
                <x-slot:content>
                    <div class="text-center grid content-center">
                        <span class="text-5xl text-gray-600 dark:text-gray-200">{{$count_invoices}}</span>
                    </div>
                </x-slot:content>
            </x-dashboard-container>
        </div>
    </div>
</div>
