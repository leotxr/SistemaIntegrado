<?php

namespace Modules\Gestao\Traits;

use Illuminate\Support\Facades\DB;

trait LaudoQueries {

    public function getLaudosStatus($date1, $date2)
    {
        return DB::connection('sqlserver')
            ->table('FATURA')
            ->leftJoin('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.MEDREAID')
            ->leftJoin('FATVOICE', function ($join_fatvoice) {
                $join_fatvoice->on('FATVOICE.UNIDADEID', '=', 'FATURA.UNIDADEID')
                    ->on('FATVOICE.PACIENTEID', '=', 'FATURA.PACIENTEID')
                    ->on('FATVOICE.FATURA', '=', 'FATURA.FATURAID');
            })
            ->leftJoin('SETORES', 'SETORES.SETORID', '=', 'FATURA.SETORID')
            //->whereIn('WORK_LIST.FILAID', $this->sec) //ressonancia
            ->whereBetween('FATURA.DATA', ["$date1", "$date2"])
            ->whereNotIn('FATURA.SETORID', [8, 12])
            ->select(DB::raw("SETORES.DESCRICAO AS NOMESETOR, FATURA.FATURAID AS EXAME, FATURA.SETORID AS SETOR, FATVOICE.ARQUIVO AS DITADO, FATURA.LAUDOREAOK AS DIGITADO, FATURA.LAUDOASSOK AS ASSINADO, MEDICOS.NOME AS MEDICO, MEDICOS.MEDICOID"))
            ->orderBy('MEDICOID')
            ->get();
    }
}
