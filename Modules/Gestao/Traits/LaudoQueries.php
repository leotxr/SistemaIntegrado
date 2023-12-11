<?php

namespace Modules\Gestao\Traits;

use Illuminate\Support\Facades\DB;

trait LaudoQueries
{

    public function queryBase()
    {
        return DB::connection('sqlserver')
            ->table('FATURA')
            ->leftJoin('FATVOICE', function ($join_fatvoice) {
                $join_fatvoice->on('FATVOICE.UNIDADEID', '=', 'FATURA.UNIDADEID')
                    ->on('FATVOICE.PACIENTEID', '=', 'FATURA.PACIENTEID')
                    ->on('FATVOICE.FATURA', '=', 'FATURA.FATURAID');
            })
            ->leftJoin('SETORES', 'SETORES.SETORID', '=', 'FATURA.SETORID');

    }

    public function getLaudosStatus($date1, $date2)
    {
        return $this->queryBase()
            ->leftJoin('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.MEDREAID')
            ->whereBetween('FATURA.DATA', ["$date1", "$date2"])
            ->whereNotIn('FATURA.SETORID', [8, 12])
            ->select(DB::raw("SETORES.DESCRICAO AS NOMESETOR, FATURA.FATURAID AS EXAME, FATURA.SETORID AS SETOR, FATVOICE.ARQUIVO AS DITADO, FATURA.LAUDOREAOK AS DIGITADO, FATURA.LAUDOASSOK AS ASSINADO, MEDICOS.NOME AS MEDICO, MEDICOS.MEDICOID"))
            ->orderBy('MEDICOID')
            ->get();
    }

    public function getLaudosRevisao($date1, $date2)
    {
        return $this->queryBase()
            ->leftJoin('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.MEDREA2ID')
            ->whereBetween('FATURA.DATA', ["$date1", "$date2"])
            ->whereIn('FATURA.SETORID', [4, 9])
            ->whereNotNull('FATVOICE.ARQUIVO')
            ->whereNull('FATURA.LAUDOREV')
            ->where('FATURA.LAUDOREAOK', 'T')
            ->where('FATURA.LAUDOASSOK', 'T')
            ->select(DB::raw("SETORES.DESCRICAO AS NOMESETOR, FATURA.FATURAID AS EXAME, FATURA.SETORID AS SETOR, FATVOICE.ARQUIVO AS DITADO, FATURA.LAUDOREAOK AS DIGITADO, FATURA.LAUDOASSOK AS ASSINADO, MEDICOS.NOME AS MEDICO, MEDICOS.MEDICOID"))
            ->orderBy('MEDICOID')
            ->get();
    }

    public function queryReports($medicos_selecionados, $setores_selecionados)
    {
        return $this->queryBase()
            ->leftJoin('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.MEDREAID')
            ->leftJoin('PACIENTE', function ($join_paciente) {
                $join_paciente->on('PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
                    ->on('PACIENTE.UNIDADEID', '=', 'PACIENTE.UNIDADEID');
            })
            ->leftJoin('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->whereNotNull('FATVOICE.ARQUIVO')
            ->whereNull('FATURA.LAUDOREV')
            ->where('FATURA.LAUDOREAOK', 'T')
            ->where('FATURA.LAUDOASSOK', 'T')
            ->whereIn('MEDICOS.NOME', $medicos_selecionados)
            ->whereIn('SETORES.DESCRICAO', $setores_selecionados)
            ->select(DB::raw("FATURA.DATA AS DATA_EXAME, FATURA.HORA AS HORA_EXAME, FATURA.ENTREGADATA AS DATA_ENTREGA, FATURA.PACIENTEID AS PACIENTEID, PACIENTE.NOME AS PACIENTENOME, PROCEDIMENTOS.DESCRICAO AS EXAME, MEDICOS.NOME AS MEDICO, SETORES.DESCRICAO AS SETOR, FATVOICE.ARQUIVO AS DITADO, FATURA.LAUDOREAOK AS DIGITADO, FATURA.LAUDOASSOK AS ASSINADO"));
    }

    public function queryReportsRevisor($medicos_selecionados, $setores_selecionados)
    {
        return $this->queryBase()
            ->leftJoin('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.MEDREA2ID')
            ->leftJoin('PACIENTE', function ($join_paciente) {
                $join_paciente->on('PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
                    ->on('PACIENTE.UNIDADEID', '=', 'PACIENTE.UNIDADEID');
            })
            ->leftJoin('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->where('FATURA.UNIDADEID', 1)
            ->whereIn('MEDICOS.NOME', $medicos_selecionados)
            ->whereIn('SETORES.DESCRICAO', $setores_selecionados)
            ->select(DB::raw("FATURA.DATA AS DATA_EXAME, FATURA.HORA AS HORA_EXAME, FATURA.ENTREGADATA AS DATA_ENTREGA, FATURA.PACIENTEID AS PACIENTEID, PACIENTE.NOME AS PACIENTENOME, PROCEDIMENTOS.DESCRICAO AS EXAME, MEDICOS.NOME AS MEDICO, SETORES.DESCRICAO AS SETOR, FATVOICE.ARQUIVO AS DITADO, FATURA.LAUDOREAOK AS DIGITADO, FATURA.LAUDOASSOK AS ASSINADO"));
    }

    public function getDoctors()
    {
        return DB::connection('sqlserver')
            ->table('MEDICOS')
            ->where('SUSPENSO', 'F')
            ->where('TIPO', 'A')
            ->where('CRM', '<>', '000001')
            ->select(DB::raw('MEDICOID, CRM, NOME'))
            ->get();
    }

    public function getSectors()
    {
        return DB::connection('sqlserver')
            ->table('SETORES')
            ->whereNotIn('SETORID', [8, 12, 6, 11, 15])
            ->select('SETORID', 'DESCRICAO')
            ->get();
    }
}
