<?php

namespace Modules\Recepcao\Http\Livewire\Schedules;

use Livewire\Component;

class ShowReport extends Component
{
    public $report = '';
    public $patient_id = '';
    public $patient_name = '';
    public $modalReport = false;

    protected $listeners = [
      'showReport'
    ];

    public function showReport($report, $patient_id, $patient_name)
    {
        $this->reset('report', 'patient_id', 'patient_name');
        $this->report = $report;
        $this->patient_id = $patient_id;
        $this->patient_name = $patient_name;
        $this->modalReport = true;
    }

    public function render()
    {
        return <<<'blade'
            <div>
        <x-modal.dialog wire:model.defer="modalReport">
            <x-slot:title>Visualização de Laudo</x-slot:title>
            <x-slot:content>
                <div id="print" class="p-4 bg-white" style="margin-top: 24px">
                <div class="py-2" style="padding-top: 24px">
                <p class="font-bold text-md text-black">Código: {{$patient_id}}</p>
                <p class="font-bold text-md text-black">Nome: {{$patient_name}}</p>
                </div>

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
                var divContents = document.getElementById("print").innerHTML;
                var printWindow = window.open('', '', 'height=500,width=400');
                printWindow.document.write('<html><head><title>Impressão de Laudo</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            }
        </script>
        </div>
        blade;
    }
}
