<div>
    <x-modal.dialog wire:model.defer="modalReport">
        <x-slot:title>Visualização de Laudo</x-slot:title>
        <x-slot:content>
            <div id="print" class="p-4 bg-white" style="margin-top: 24px">
                <div class="py-2" style="padding-top: 24px; width: 100%;">
                    <div>
                        <div style="flex: max-content">
                            <div style="text-align: start">
                                <p class="font-bold text-md text-black" style="text-align: start">
                                    <strong>Código:</strong> {{$patient_id}}</p>
                                <span class="font-bold text-md text-black"
                                      style="text-align: start"><strong>Nome:</strong> {{$patient_name}}</span>
                                <span class="font-bold text-md text-black" style="text-align: end"><strong>Data do exame:</strong> {{date('d/m/Y', strtotime($exam_date))}}</span>
                                <p class="font-bold text-md text-black" style="text-align: end"><strong>Médico
                                        Assinante:</strong> {{$doctor}}</p>

                            </div>
                            <div style="text-align: end">

                                <p><i>Usuário: {{auth()->user()->name}}</i></p>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    echo $report;
                @endphp

                <div style="bottom: 0;">
                    <p><i>Usuário: {{auth()->user()->name}}</i></p>
                    <p>{{now()->format('d/m/Y H:i:s')}}</p>
                </div>
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
            var divContents = document.getElementById("print").innerHTML;
            var footerContents = document.getElementById("footer").innerHTML;
            var printWindow = window.open('', '', 'height=500,width=400');
            printWindow.document.write('<html><head><title>Impressão de Laudo</title>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(divContents);
            printWindow.document.write('</body>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</div>
