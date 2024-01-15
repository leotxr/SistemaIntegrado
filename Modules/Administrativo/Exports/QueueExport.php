<?php

namespace Modules\Administrativo\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Administrativo\Traits\ReceptionTrait;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Gestao\Traits\LaudoQueries;

class QueueExport implements FromView
{
    use Exportable;
    use ReceptionTrait;

    public $start;
    public $end;

    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
    }


    public function getReport()
    {
        return $this->getWaitQueue($this->start, $this->end)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->selectRaw('USUARIOS.NOME AS USUARIO, USUARIOS.USERID AS USERID');
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {


        return view(
            'administrativo::utils.reception.table-export-queue',
            ['query' => $this->getReport()->get(),
                'total_count' => $this->getReport()->get(),
                'users' => DB::connection('sqlserver')
                    ->table('USUARIOS')
                    ->whereIn('USUARIOS.GRUPOID', [45, 53])
                    ->selectRaw('USUARIOS.NOME AS USUARIO_NOME, USUARIOS.USERID AS USUARIO_ID, USUARIOS.GRUPOID AS USUARIO_GRUPOID')->get()]
        );
    }
}
