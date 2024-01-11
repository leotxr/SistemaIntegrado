<?php

namespace Modules\Triagem\Traits;

use Illuminate\Support\Facades\DB;

trait WorkListQueries
{

    public function getPatient($patient_id, $sector_id)
    {
        return DB::connection('sqlserver')
            ->table('FATURA')
            ->where('PACIENTE.PACIENTEID', '=', $patient_id)
            ->where('FATURA.SETORID', $sector_id)
            ->where('DATA', date('Y-m-d'))
            ->join('PACIENTE', 'PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
            ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->select('PACIENTE.PACIENTEID', 'FATURA.DATA', 'PACIENTE.NOME', 'PACIENTE.DATANASC', 'PROCEDIMENTOS.DESCRICAO')
            ->first();
    }

    public function getMonitoringData($sector_id, $date)
    {
        return DB::connection('sqlserver')
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
            ->whereIn('WORK_LIST.FILAID', $sector_id) //ressonancia
            ->where('WORK_LIST.DATA', '=', $date)
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
        CONVERT(VARCHAR,WORK_LIST.HORACHEGOU,108) AS CHEGOU,
        FATURA.SETORID,
        WORK_LIST.STATUSID"));
    }
}
