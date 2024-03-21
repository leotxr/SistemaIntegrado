<?php

namespace Modules\Recepcao\Http\Livewire\Monitoring\Dashboard;

use Livewire\Component;
use Modules\Administrativo\Traits\ReceptionTrait;

class WaitQueue extends Component
{

    use ReceptionTrait;

    public $queue;
    public $waiting;
    public $scheduling;
    public $service;
    public $agenda;
    public $served;
    public $served_scheduling;
    public $served_service;
    public $green;
    public $yellow;
    public $red;
    public $today;

    public $delays = [];

    protected $listeners = ['refreshQueue' => 'refreshMe'];



    public function setQueues()
    {

        $this->queue = $this->getWaitQueue($this->today, $this->today)->count();
        //$this->served = $this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->get();
        $this->scheduling = $this->getWaitQueue($this->today, $this->today)->where('TOTEM_FILAS_ESPERA.ATENDIDO', 'F')->where('TOTEM_FILAS_ESPERA.TIPOFILA', 'T')->get();
        $this->service = $this->getWaitQueue($this->today, $this->today)
            ->join('HORARIOS', 'HORARIOS.HORREQID', '=', 'TOTEM_FILAS_ESPERA.HORREQID')
            ->whereNull('HORARIOS.MASTERHORA')
            ->where('TOTEM_FILAS_ESPERA.ATENDIDO', 'F')
            ->whereIn('TOTEM_FILAS_ESPERA.TIPOFILA', ['A', 'P'])
            ->selectRaw('HORARIOS.HORA AS HORA_EXAME')
            ->get();
        $this->served_scheduling = $this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->where('TOTEM_FILAS_ESPERA.TIPOFILA', 'T')->count();
        $this->served_service = $this->getWaitQueue($this->today, $this->today)
            ->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereIn('TOTEM_FILAS_ESPERA.TIPOFILA', ['A', 'P'])->count();

        //$this->waiting = $this->getWaitQueue($this->today, $this->today)->where('TOTEM_FILAS_ESPERA.ATENDIDO', 'F')->get();

        //dd($this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->get());

    }

    public function setDelays()
    {
        $this->delays[0] = $this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereRaw('TOTEM_FILAS_ESPERA.HORA_ATEND - TOTEM_FILAS_ESPERA.HORACHEGADA < 600')->count();
        $this->delays[1] = $this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereRaw('TOTEM_FILAS_ESPERA.HORA_ATEND - TOTEM_FILAS_ESPERA.HORACHEGADA >= 600 AND TOTEM_FILAS_ESPERA.HORA_ATEND - TOTEM_FILAS_ESPERA.HORACHEGADA < 900')->count();
        $this->delays[2] = $this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')
            ->whereRaw('TOTEM_FILAS_ESPERA.HORA_ATEND - TOTEM_FILAS_ESPERA.HORACHEGADA >= 900')->count();
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
        return view('recepcao::livewire.monitoring.dashboard.wait-queue');
    }
}
