<?php

namespace Modules\Recepcao\Http\Livewire\Schedules;

use Livewire\Component;

class ShowReport extends Component
{
    public $report = '';
    public $patient_id = '';
    public $patient_name = '';
    public $exam_date = '';
    public $modalReport = false;

    protected $listeners = [
      'showReport'
    ];

    public function showReport($report, $patient_id, $patient_name, $date)
    {
        $this->reset('report', 'patient_id', 'patient_name');
        $this->report = $report;
        $this->patient_id = $patient_id;
        $this->patient_name = $patient_name;
        $this->exam_date = $date;
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
                    <div class="py-2" style="padding-top: 24px; width: 100%;">
                        <div style="text-align: start">
                            <p class="font-bold text-md text-black"><strong>Código:</strong> {{$patient_id}}</p>
                            <p class="font-bold text-md text-black"><strong>Nome:</strong> {{$patient_name}}</p>
                        </div>
                        <div style="text-align: end">
                            <p class="font-bold text-md text-black"><strong>Data do exame:</strong> {{date('d/m/Y', strtotime($exam_date))}}</p>
                        </div>
                    </div>

                    @php
                        echo $report;
                    @endphp

                    <div style="bottom: 0;">
                        <p>Usuário: {{auth()->user()->name}}</p>
                        <p>{{date('d/m/Y')}}</p>
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
