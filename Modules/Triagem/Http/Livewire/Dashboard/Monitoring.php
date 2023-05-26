<?php

namespace Modules\Triagem\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Modules\Triagem\Entities\Term;
use Livewire\WithPagination;
use Modules\Triagem\Entities\Sector;

class Monitoring extends Component
{
    use WithPagination;

    public $date;
    public $modalTriagem = false;
    public $sectors;
    public $sec = [14, 31];
    public $showing;

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->sectors = Sector::all();
    }

    public function showTriagem($patient_id)
    {
        $this->modalTriagem = true;
        $this->showing = Term::where('patient_id', $patient_id)->first();


    }

    public function render()
    {

        return view('triagem::livewire.dashboard.monitoring', ['pacientes' => DB::connection('sqlserver')
        ->table('WORK_LIST')
        ->join('FATURA', function ($join) {
            $join->on('FATURA.FATURAID', '=', 'WORK_LIST.FATURAID')
                ->on('FATURA.UNIDADEID', '=', 'WORK_LIST.UNIDADEID')
                ->on('FATURA.PACIENTEID', '=', 'WORK_LIST.PACIENTEID')
                ->on('FATURA.REQUISICAOID', '=', 'WORK_LIST.REQUISICAOID');
        })
        ->leftJoin('PACIENTE', function ($join_pac) {
            $join_pac->on('PACIENTE.PACIENTEID', '=', 'WORK_LIST.PACIENTEID')
                ->on('PACIENTE.UNIDADEID', '=', 'FATURA.UNIDADEPACIENTEID');
        })
        ->leftJoin('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
        ->leftJoin('WORK_FILAS', 'WORK_FILAS.FILAID', '=', 'WORK_LIST.FILAID')


        ->whereIn('WORK_LIST.FILAID', $this->sec) //ressonancia
        ->where('WORK_LIST.DATA', '=', $this->date)
        ->orderBy('ENTRADA')
        ->select(DB::raw("WORK_LIST.DATA, 
        RIGHT('0' + CAST(WORK_LIST.HORAAGENDA / 3600 AS VARCHAR),2) + ':' + 
        RIGHT('0' + CAST((WORK_LIST.HORAAGENDA / 60) % 60 AS VARCHAR),2) + ':' + 
        RIGHT('0' + CAST(WORK_LIST.HORAAGENDA % 60 AS VARCHAR),2) AS HORA,
        WORK_LIST.PACIENTEID,    
        PACIENTE.NOME PACIENTE,      
        PROCEDIMENTOS.DESCRICAO PROCEDIMENTO,
        WORK_FILAS.FILANOME AS SETOR,
        CONVERT(VARCHAR,WORK_LIST.HORAATENDE,108) AS ENTRADA,
        CONVERT(VARCHAR,WORK_LIST.HORASAIDA,108) AS SAIDA,
        FATURA.SETORID, 
        WORK_LIST.STATUSID"))
        ->paginate(10), 'triagens' => Term::whereDate('exam_date', $this->date)->get(), ]);
    }
}
