<?php

namespace Modules\Recepcao\Http\Livewire\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Administrativo\Exports\QueueExport;
use Modules\Administrativo\Traits\ReceptionTrait;

class WaitQueueReport extends Component
{
    use ReceptionTrait;
    use WithPagination;

    public $start_date;
    public $end_date;
    public $limit = 10;
    public $limits = [10, 20, 30, 40, 50, 100, 150, 200];


    public function mount()
    {
        //$this->query = $this->getWaitQueue($this->start_date, $this->end_date)->get();
        //$this->query = $this->getReport()->paginate(10);
    }

    public function getReport()
    {
        return $this->getWaitQueue($this->start_date, $this->end_date)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->selectRaw('USUARIOS.NOME AS USUARIO, USUARIOS.USERID AS USERID');
    }

    public function search()
    {
        //$this->render();

        return $this->getReport();
    }

    public function exportXLS()
    {
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
        return Excel::download(new QueueExport($range), 'fila-espera-recepcao-' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function render()
    {
        return view('recepcao::livewire.reports.wait-queue-report',
            ['query' => $this->search()->offset(0)->limit($this->limit)->get(),
                'total_count' => $this->search()->get(),
                //'users' => DB::connection('sqlserver')
                //->table('USUARIOS')
                // ->whereIn('USUARIOS.GRUPOID', [45, 53])
                // ->selectRaw('USUARIOS.NOME AS USUARIO_NOME, USUARIOS.USERID AS USUARIO_ID, USUARIOS.GRUPOID AS USUARIO_GRUPOID')->get()
            ]);
    }
}
