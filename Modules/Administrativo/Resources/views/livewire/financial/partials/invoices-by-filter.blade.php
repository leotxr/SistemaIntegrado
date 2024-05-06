<div>
    <div>

    </div>
   <x-dashboard-container>
       <x-slot:title>Faturas do período</x-slot:title>
       <x-slot:description>Mostra as faturas do período selecionado</x-slot:description>
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
                       <x-table.row>
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
</div>
