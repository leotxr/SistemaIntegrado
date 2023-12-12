<?php

namespace Modules\Gestao\Exports\Laudo;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Gestao\Traits\LaudoQueries;

class ExamsExport implements FromView
{
    use Exportable;
    use LaudoQueries;

    public $start;
    public $end;
    public $medicos;
    public $setores;
    public $date_by;
    public $query;

    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
        $this->medicos = $range['medicos_selecionados'];
        $this->setores = $range['setores_selecionados'];
        $this->date_by = $range['date_by'];
        $this->query = $range['query_type'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        switch ($this->query) {
            case 1:
                $db = $this->queryReports($this->medicos, $this->setores)
                    ->where('FATURA.LAUDOREAOK', 'F')
                    ->whereNull('FATVOICE.ARQUIVO')
                    ->whereBetween("$this->date_by", ["$this->start", "$this->end"])
                    ->orderBy('HORA_EXAME')
                    ->get();
                break;

            case 2:
                $db = $this->queryReports($this->medicos, $this->setores)
                    ->where('FATURA.LAUDOREAOK', 'T')
                    ->where('FATURA.LAUDOASSOK', 'F')
                    ->whereBetween("$this->date_by", ["$this->start", "$this->end"])
                    ->orderBy('HORA_EXAME')
                    ->get();
                break;

            case 3:
                $db = $this->queryReportsRevisor($this->medicos, $this->setores)
                    ->whereNotNull('FATVOICE.ARQUIVO')
                    ->whereNull('FATURA.LAUDOREV')
                    ->where('FATURA.LAUDOREAOK', 'T')
                    ->where('FATURA.LAUDOASSOK', 'T')
                    ->whereBetween("$this->date_by", ["$this->start", "$this->end"])
                    ->orderBy('HORA_EXAME');
                break;
        }
        return view(
            'gestao::livewire.utils.laudo.tables.table-exams-export',
            ['db' => $db]
        );
    }
}
