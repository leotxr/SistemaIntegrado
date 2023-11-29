<?php

namespace Modules\Gestao\Traits;

use Illuminate\Support\Facades\DB;

trait LaudoQueries {

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
}
