<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\Sector;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class GetFilasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function getRessonancia()
    {
        $hoje = date('m/d/Y');
        $hoje_mysql = date('Y-m-d');
        $pacientes = DB::connection('sqlserver')
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


            ->where('WORK_LIST.FILAID', '=', 31) //ressonancia
            ->where('WORK_LIST.DATA', '=', $hoje)
            ->orderBy('HORA')
            ->select(DB::raw("WORK_LIST.DATA,
            RIGHT('0' + CAST(WORK_LIST.HORAAGENDA / 3600 AS VARCHAR),2) + ':' +
            RIGHT('0' + CAST((WORK_LIST.HORAAGENDA / 60) % 60 AS VARCHAR),2) + ':' +
            RIGHT('0' + CAST(WORK_LIST.HORAAGENDA % 60 AS VARCHAR),2) AS HORA,
            WORK_LIST.PACIENTEID,
            PACIENTE.NOME PACIENTE,
            PROCEDIMENTOS.DESCRICAO PROCEDIMENTO,
            WORK_FILAS.FILANOME AS SETOR,
            FATURA.SETORID,
            WORK_LIST.STATUSID"))
            ->get();

        $triagens = Term::whereDate('exam_date', $hoje_mysql)->get();

        return view('triagem::ressonancia.queue', ['pacientes' => $pacientes, 'hoje' => $hoje, 'triagens' => $triagens, 'setor' => Sector::find(1)]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function getTomografia()
    {
        $hoje = date('m/d/Y');
        $hoje_mysql = date('Y-m-d');

        $pacientes = DB::connection('sqlserver')
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


            ->where('WORK_LIST.FILAID', '=', 14) //tomografia
            ->where('WORK_LIST.DATA', '=', $hoje)
            ->orderBy('HORA')
            ->select(DB::raw("WORK_LIST.DATA,
            RIGHT('0' + CAST(WORK_LIST.HORAAGENDA / 3600 AS VARCHAR),2) + ':' +
            RIGHT('0' + CAST((WORK_LIST.HORAAGENDA / 60) % 60 AS VARCHAR),2) + ':' +
            RIGHT('0' + CAST(WORK_LIST.HORAAGENDA % 60 AS VARCHAR),2) AS HORA,
            WORK_LIST.PACIENTEID,
            PACIENTE.NOME PACIENTE,
            PROCEDIMENTOS.DESCRICAO PROCEDIMENTO,
            WORK_FILAS.FILANOME AS SETOR,
            FATURA.SETORID,
            WORK_LIST.STATUSID"))
            ->get();

            $triagens = Term::whereDate('exam_date', $hoje_mysql)->get();

        return view('triagem::tomografia.queue', ['pacientes' => $pacientes, 'hoje' => $hoje, 'triagens' => $triagens, 'setor' => Sector::find(2)]);
    }

    public function getRessonanciaSub()
    {
        $hoje = date('m/d/Y');
        $hoje_mysql = date('Y-m-d');
        $pacientes = DB::connection('sqlserver')
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


            ->where('WORK_LIST.FILAID', '=', 52) //ressonancia
            ->where('WORK_LIST.DATA', '=', $hoje)
            ->orderBy('HORA')
            ->select(DB::raw("WORK_LIST.DATA,
            RIGHT('0' + CAST(WORK_LIST.HORAAGENDA / 3600 AS VARCHAR),2) + ':' +
            RIGHT('0' + CAST((WORK_LIST.HORAAGENDA / 60) % 60 AS VARCHAR),2) + ':' +
            RIGHT('0' + CAST(WORK_LIST.HORAAGENDA % 60 AS VARCHAR),2) AS HORA,
            WORK_LIST.PACIENTEID,
            PACIENTE.NOME PACIENTE,
            PROCEDIMENTOS.DESCRICAO PROCEDIMENTO,
            WORK_FILAS.FILANOME AS SETOR,
            FATURA.SETORID,
            WORK_LIST.STATUSID"))
            ->get();

        $triagens = Term::whereDate('exam_date', $hoje_mysql)->get();

        return view('triagem::ressonancia.queue', ['pacientes' => $pacientes, 'hoje' => $hoje, 'triagens' => $triagens, 'setor' => Sector::find(3)]);
    }
}
