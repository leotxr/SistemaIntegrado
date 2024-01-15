<?php

namespace Modules\Administrativo\Http\Livewire\Monitoring;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Modules\Administrativo\Traits\ReceptionTrait;

class ReceptionQueue extends Component
{

    use ReceptionTrait;

    public $queue;
    public $waiting;
    public $agenda;
    public $served;
    public $green;
    public $yellow;
    public $red;
    public $today;

    public $delays = [];

    protected $listeners = ['refreshQueue' => 'refreshMe'];



    public function setQueues()
    {

        $this->queue = $this->getWaitQueue($this->today, $this->today)->get();
        $this->served = $this->getWaitQueue($this->today, $this->today)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->get();
        $this->waiting = $this->getWaitQueue($this->today, $this->today)->where('TOTEM_FILAS_ESPERA.ATENDIDO', 'F')->get();

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
