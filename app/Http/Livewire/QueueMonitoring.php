<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class QueueMonitoring extends Component
{
    public $filas;
    public $count_filas;

    public function mount()
    {
        $this->filas = collect([
            ['id' => 17, 'name' => 'Dr. Celio'],
            ['id' => 18, 'name' => 'Dr. Marcio'],
            ['id' => 19, 'name' => 'Dr. Rafael'],
            ['id' => 21, 'name' => 'Dra. Marcella'],
            ['id' => 22, 'name' => 'Dra. Flavia'],
            ['id' => 30, 'name' => 'Dra. Kessia'],
            ['id' => 36, 'name' => 'Dr. Vinicius'],
            ['id' => 39, 'name' => 'Dr. Rodrigo'],
            ['id' => 40, 'name' => 'Dra. Priscilla'],
            ['id' => 42, 'name' => 'Dra. Bianca'],
        ]);

        $this->count_filas = $this->filas->pluck('id');
    }

    public function render()
    {
        return view('livewire.queue-monitoring', [
            'queue' =>
            DB::connection('sqlserver')->table('WORK_LIST')
                ->leftJoin('FATURA', function ($join_fatura) {
                    $join_fatura->on('FATURA.FATURAID', '=', 'WORK_LIST.FATURAID')
                        ->on('FATURA.UNIDADEID', '=', 'WORK_LIST.UNIDADEID')
                        ->on('FATURA.PACIENTEID', '=', 'WORK_LIST.PACIENTEID')
                        ->on('FATURA.REQUISICAOID', '=', 'WORK_LIST.REQUISICAOID');
                })
                ->leftJoin('PACIENTE', function ($join_paciente) {
                    $join_paciente->on('PACIENTE.PACIENTEID', '=', 'WORK_LIST.PACIENTEID')
                        ->on('PACIENTE.UNIDADEID', '=', 'FATURA.UNIDADEPACIENTEID');
                })
                ->leftJoin('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
                ->leftJoin('CONVENIOS', 'CONVENIOS.CONVENIOID', '=', 'FATURA.CONVENIOID')
                ->leftJoin('SETORES', 'SETORES.SETORID', '=', 'FATURA.SETORID')
                ->leftJoin('RESULTADOEXAME', 'RESULTADOEXAME.RESULT_EXAMEID', '=', 'FATURA.RESULT_EXAMEID')
                ->leftJoin('WORK_FILAS', 'WORK_FILAS.FILAID', '=', 'WORK_LIST.FILAID')
                ->leftJoin('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.TECNICOID')
                ->whereBetween('WORK_LIST.DATA', ['2023-07-11', '2023-07-11'])
                ->where('PACIENTE.UNIDADEID', 1)
                ->select(DB::raw("PACIENTE.NOME AS NOME, WORK_FILAS.FILAID AS FILAID, WORK_LIST.STATUSID AS STATUSID"))
                ->distinct()
                ->get()
        ]);
    }
}
