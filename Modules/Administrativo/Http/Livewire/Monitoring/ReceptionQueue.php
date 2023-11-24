<?php

namespace Modules\Administrativo\Http\Livewire\Monitoring;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ReceptionQueue extends Component
{

    public $queue;
    public $waiting;
    public $served;
    public $green;
    public $yellow;
    public $red;
    public $today;

    public $delays = [];

    protected $listeners = ['refreshQueue' => 'refreshMe'];

    public function getWaitQueue($date)
    {
        return DB::connection('sqlserver')
            ->table('TOTEM_FILAS_ESPERA')
            // ->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereBetween('TOTEM_FILAS_ESPERA.DATA', [$date, $date])
            ->select(DB::raw("TOTEM_FILAS_ESPERA.SENHA AS SENHA,
            TOTEM_FILAS_ESPERA.HORACHEGADA AS HORACHEGADA,
            TOTEM_FILAS_ESPERA.HORA_ATEND AS HORAATEND,
            TOTEM_FILAS_ESPERA.HORA_ATEND - TOTEM_FILAS_ESPERA.HORACHEGADA AS ATRASO_ATEND,
            TOTEM_FILAS_ESPERA.TIPOFILA AS TIPOFILA,
            TOTEM_FILAS_ESPERA.ATENDIDO AS ATENDIDO,
            (DATEDIFF(second,0,CONVERT (TIME, GETDATE())) - TOTEM_FILAS_ESPERA.HORACHEGADA) AS ATRASO"));
    }

    public function setQueues()
    {

        $this->queue = $this->getWaitQueue($this->today)->get();
        $this->served = $this->getWaitQueue($this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->get();
        $this->waiting = $this->getWaitQueue($this->today)->where('TOTEM_FILAS_ESPERA.ATENDIDO', 'F')->get();

        /*
                $this->green = $this->served->where('ATRASO_ATEND', '<', 600)->count();
                $this->yellow = $this->served->where('ATRASO_ATEND', '>=', 600)->where('ATRASO_ATEND', '<', 900)->count();
                $this->red = $this->served->where('ATRASO_ATEND', '>=', 900)->count();
        */


        //dd($this->queue, $this->served, $this->waiting);
    }

    public function setDelays()
    {
        $this->delays[0] = $this->served->where('ATRASO_ATEND', '<', 600)->count();
        $this->delays[1] = $this->served->where('ATRASO_ATEND', '>=', 600)->where('ATRASO_ATEND', '<', 900)->count();
        $this->delays[2] = $this->served->where('ATRASO_ATEND', '>=', 900)->count();
    }

    public function refreshMe()
    {
        $this->today = now()->format('Y-m-d');
        $this->setQueues();
        $this->setDelays();
    }

    public function mount()
    {
        $this->today = now()->format('Y-m-d');
        $this->setQueues();
        $this->setDelays();
    }


    public function render()
    {
        return view(
            'administrativo::livewire.monitoring.reception-queue'
        );
    }
}
