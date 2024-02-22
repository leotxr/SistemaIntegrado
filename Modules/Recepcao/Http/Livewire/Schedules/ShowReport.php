<?php

namespace Modules\Recepcao\Http\Livewire\Schedules;

use Livewire\Component;

class ShowReport extends Component
{
    public $report = '';
    public $modalReport = false;

    protected $listeners = [
      'showReport'
    ];

    public function showReport($report)
    {
        $this->reset('report');
        $this->report = $report;
        $this->modalReport = true;
    }

    public function render()
    {
        return <<<'blade'
            <div>
        <x-modal.dialog wire:model.defer="modalReport">
            <x-slot:title>Visualização de Laudo</x-slot:title>
            <x-slot:content>
                <div id="print" class="bg-white">
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
