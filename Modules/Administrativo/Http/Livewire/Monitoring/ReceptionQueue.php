<?php

namespace Modules\Administrativo\Http\Livewire\Monitoring;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReceptionQueue extends Component
{

    public $queue;
    public $waiting;
    public $served;
    public $queue_types;
    public $today;

    protected $listeners = ['refreshQueue' => 'refreshMe'];

    public function getWaitQueue($date)
    {
        return DB::connection('sqlserver')
            ->table('TOTEM_FILAS_ESPERA')
            // ->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereBetween('TOTEM_FILAS_ESPERA.DATA', [$date, $date])
            ->select(DB::raw("TOTEM_FILAS_ESPERA.SENHA AS SENHA, TOTEM_FILAS_ESPERA.HORACHEGADA AS HORACHEGADA, TOTEM_FILAS_ESPERA.HORA_ATEND AS HORAATEND, TOTEM_FILAS_ESPERA.TIPOFILA AS TIPOFILA, TOTEM_FILAS_ESPERA.ATENDIDO AS ATENDIDO, (DATEDIFF(second,0,CONVERT (TIME, GETDATE())) - TOTEM_FILAS_ESPERA.HORACHEGADA) AS ATRASO"));
    }

    public function setQueues()
    {
        $this->queue = $this->getWaitQueue($this->today)->get();
        $this->served = $this->getWaitQueue($this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->get();
        $this->waiting = $this->getWaitQueue($this->today)->where('TOTEM_FILAS_ESPERA.ATENDIDO', 'F')->get();
    }


    public function refreshMe()
    {
        $this->today = now()->format('Y-m-d');
        $this->setQueues();
    }

    public function mount()
    {
        $this->today = now()->format('Y-m-d');
        $this->setQueues();
    }


    public function render()
    {
        return view(
            'administrativo::livewire.monitoring.reception-queue'
        );
    }
}
