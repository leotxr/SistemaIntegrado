<?php

namespace Modules\Administrativo\Traits;
use Illuminate\Support\Facades\DB;

trait ReceptionTrait
{
    public function getWaitQueue($date1, $date2)
    {
        return DB::connection('sqlserver')
            ->table('TOTEM_FILAS_ESPERA')
            // ->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereBetween('TOTEM_FILAS_ESPERA.DATA', [$date1, $date2])
            ->whereNull('TOTEM_FILAS_ESPERA.USERID_REMOCAO')
            ->select(DB::raw("TOTEM_FILAS_ESPERA.SENHA AS SENHA,
            TOTEM_FILAS_ESPERA.HORACHEGADA AS HORACHEGADA,
            TOTEM_FILAS_ESPERA.HORA_ATEND AS HORAATEND,
            TOTEM_FILAS_ESPERA.HORREQID AS HORAEXAME,
            TOTEM_FILAS_ESPERA.HORA_ATEND - TOTEM_FILAS_ESPERA.HORACHEGADA AS ATRASO_ATEND,
            TOTEM_FILAS_ESPERA.TIPOFILA AS TIPOFILA,
            TOTEM_FILAS_ESPERA.ATENDIDO AS ATENDIDO,
            TOTEM_FILAS_ESPERA.DATA AS DATA,
            (DATEDIFF(second,0,CONVERT (TIME, GETDATE())) - TOTEM_FILAS_ESPERA.HORACHEGADA) AS ATRASO"));
    }
}
