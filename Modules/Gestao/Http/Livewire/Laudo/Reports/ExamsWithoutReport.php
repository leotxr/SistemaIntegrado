<?php

namespace Modules\Gestao\Http\Livewire\Laudo\Reports;

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Autorizacao\Exports\ExamReportExport;
use Modules\Gestao\Exports\Laudo\ExamsExport;
use Modules\Gestao\Traits\LaudoQueries;
use App\Models\User;

class ExamsWithoutReport extends Component
{
    use LaudoQueries;
    use WithPagination;

    public $medicos;
    public $setores;
    public $selection;
    public $selectAll = false;
    public $date_by = 'FATURA.DATA';
    public $medicos_selecionados = [];
    public $setores_selecionados = [];
    public $modal_medicos = false;
    public $modal_setores = false;
    public $start_date;
    public $end_date;


    public function mount()
    {
        $this->medicos = json_decode(json_encode($this->getDoctors()), true);
        $this->setores = json_decode(json_encode($this->getSectors()), true);

    }

    public function search()
    {
        $this->render();
        //$this->searching = $query;
    }

    public function selectAll()
    {
        if ($this->selectAll) {
            $this->medicos_selecionados = array_column($this->medicos, 'NOME');
        } else
            $this->medicos_selecionados = [];

    }

    public function export()
    {
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'date_by' => $this->date_by,
            'medicos_selecionados' => $this->medicos_selecionados,
            'setores_selecionados' => $this->setores_selecionados,
            'query_type' => 1
        ];
        return Excel::download(new ExamsExport($range), 'exams-sem-laudar' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function remove($arr_ref, $name)
    {
        switch ($arr_ref) {
            case 1:
                $key = array_search($name, $this->medicos_selecionados);
                unset($this->medicos_selecionados[$key]);
                break;
            case 2:
                $key = array_search($name, $this->setores_selecionados);
                unset($this->setores_selecionados[$key]);
                break;

        }

    }

    public function render()
    {

        return view('gestao::livewire.laudo.reports.exams-without-report',
            ['db' => $this->queryReports($this->medicos_selecionados, $this->setores_selecionados)
                ->where('FATURA.LAUDOREAOK', 'F')
                ->whereNull('FATVOICE.ARQUIVO')
                ->whereBetween("$this->date_by", ["$this->start_date", "$this->end_date"])
                ->orderBy('HORA_EXAME')
                ->paginate(20)]);
    }
}
