<div class="text-sm divide-y-2 space-y-2">
    <div>
        <p class="font-bold">Resumo do processamento de desconto no faturamento de Exames por Médico</p>
        <p>Período: {{date('d/m/y', strtotime($start_date))}} até {{date('d/m/y', strtotime($end_date))}}</p>
        <p>Medico: {{$doctor->name}}</p>
    </div>
    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Data Exame</x-table.heading>
                <x-table.heading>Fatura</x-table.heading>
                <x-table.heading>ID Paciente</x-table.heading>
                <x-table.heading>Nome Paciente</x-table.heading>
                <x-table.heading>Exame</x-table.heading>
                <x-table.heading>Convênio</x-table.heading>
                <x-table.heading>Valor</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach($query as $invoice)
                    <x-table.row>
                        <x-table.cell>{{date('d/m/y', strtotime($invoice->exam_date))}}</x-table.cell>
                        <x-table.cell>{{$invoice->invoice_id}}</x-table.cell>
                        <x-table.cell>{{$invoice->patient_id}}</x-table.cell>
                        <x-table.cell>{{$invoice->patient_name}}</x-table.cell>
                        <x-table.cell>{{$invoice->exam_description}}</x-table.cell>
                        <x-table.cell>{{$invoice->insurance}}</x-table.cell>
                        <x-table.cell>R$ {{$invoice->total_value}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>
    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Total de exames descontados</x-table.heading>
                <x-table.heading>Valor Bruto Descontados</x-table.heading>
                <x-table.heading>Percentual de Desconto</x-table.heading>
                <x-table.heading>Valor Líquido Desconto</x-table.heading>
            </x-slot>
            <x-slot name="body">
                <x-table.row>
                    <x-table.cell>{{$query->count()}}</x-table.cell>
                    <x-table.cell>{{number_format((float)$discount_value, 2, '.', '')}}</x-table.cell>
                    <x-table.cell>{{$discount_percent}}%</x-table.cell>
                    <x-table.cell>{{number_format((float)$liquid_discount_value, 2, '.', '')}}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Total de exames pagos</x-table.heading>
                <x-table.heading>Valor Bruto Pagos</x-table.heading>
                <x-table.heading>Percentual de Pagamento</x-table.heading>
                <x-table.heading>Valor Líquido Pagamento</x-table.heading>
            </x-slot>
            <x-slot name="body">
                <x-table.row>
                    <x-table.cell>{{$invoices_payment->count()}}</x-table.cell>
                    <x-table.cell>{{number_format((float)$payment_value, 2, '.', '')}}</x-table.cell>
                    <x-table.cell>{{$payment_percent}}%</x-table.cell>
                    <x-table.cell>{{number_format((float)$liquid_payment_value, 2, '.', '')}}</x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table>
    </div>
</div>

