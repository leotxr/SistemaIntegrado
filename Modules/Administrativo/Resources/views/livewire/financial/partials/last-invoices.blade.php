<x-dashboard-container height="md" width="full">
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

