<div>
    <x-modal.dialog wire:model.defer="modalReport">
        <x-slot:title>Visualização de Laudo</x-slot:title>
        <x-slot:content>
            <div id="print" class="p-4 bg-white" style="margin-top: 24px">
                @php
                    echo $report;
                @endphp
            </div>

        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
                <x-primary-button onclick="PrintDiv();">Imprimir</x-primary-button>
            </div>
        </x-slot:footer>
    </x-modal.dialog>
    <script type="text/javascript">

        function PrintDiv() {
            var data = {
                patient_name: @this.patient_name,
                patient_id: @this.patient_id,
                doctor: @this.doctor,
                exam_date: @this.exam_date,
                report: @this.report,
                user: @this.user
            }
            var header = "<p>NOME:" + data.patient_name + "</p><p>DATA DO EXAME:" + data.exam_date + "</p>";
            //var headerContent = document.getElementById("header").innerHTML;
            var printWindow = window.open('', '', 'height=500,width=400');
            printWindow.document.write('<html><head><title>Impressão de Laudo</title>');
            printWindow.document.write('<link rel="stylesheet" href="{{asset('report-print-layout.css')}}">');
            printWindow.document.write('<style>@page{size:A4; margin-top:2cm; margin-bottom: 1cm;}</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<table><thead><tr><td><div style=" display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); justify-content: space-between; margin: 20px;">')
            printWindow.document.write('<div style="grid-column: span 1 / span 1;"><b>NOME:</b> ' + data.patient_name + '</div><div style="grid-column: span 1 / span 1;"><b>DATA DO EXAME:</b> ' + data.exam_date + '</div>');
            printWindow.document.write('<div style="grid-column: span 1 / span 1;"><b>CÓDIGO:</b> ' + data.patient_id + '</div><div style="grid-column: span 1 / span 1;"><b>ASSINADO POR:</b> ' + data.doctor + '</div>');
            printWindow.document.write('</div></td></tr></thead>')
            printWindow.document.write('<tbody><tr><td><div>' + data.report + '</div></td></tr></tbody>');
            printWindow.document.write('<tfoot><tr><td><div style=" display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); justify-content: space-between; margin: 20px;"> ');
            printWindow.document.write('<div style="grid-column: span 1 / span 1;">Usuário: ' + data.user  + '</div><div style="grid-column: span 1 / span 1;"><b>ASSINADO POR:</b> ' + data.doctor + '</div>');
            printWindow.document.write('</div></td></tr></tfoot></table>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</div>
