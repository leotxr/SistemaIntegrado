<?php

namespace Modules\Autorizacao\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;

class FormSearch extends Component
{
    use WithFileUploads;

    public $dadosSolicitacao = false;
    public $protocol;
    //public $show_data_protocol;
    public $photo;
    public $formProtocol = true;
    public Collection $inputs;

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['email' => '']]),
        ]);
    }

    public function addInput()
    {
        $this->inputs->push(['exam' => '']);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }


    protected $rules = [
        'protocol' => 'required|min:6',
        'show_data_protocol.HORREQID' => 'required',
        'show_data_protocol.CONVENIOID' => 'required'
    ];



    public function render()
    {

        $hoje = date('Y-m-d');
        $datafim = date('Y-m-d', strtotime('+1 days'));

        $pacientes = DB::connection('sqlserver')
            ->table('VW_AGENDA')
            ->where('VW_AGENDA.HORREQID', '=', $this->protocol)
            ->select('VW_AGENDA.NOMEPAC', 'VW_AGENDA.PACIENTEID', 'VW_AGENDA.CONVENIOID')
            ->first();

        if ($pacientes) {
            $protocolos = DB::connection('sqlserver')
                ->table('VW_AGENDA')
                ->join('VW_CL_AGENDA_PORTALAGENDA', function ($join) {
                    $join->on('VW_CL_AGENDA_PORTALAGENDA.HORREQID', '=', 'VW_AGENDA.HORREQID')
                        ->on('VW_CL_AGENDA_PORTALAGENDA.HORA', '=', 'VW_AGENDA.HORA');
                })
                ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'VW_CL_AGENDA_PORTALAGENDA.PROCID')
                ->where('VW_AGENDA.HORREQID', '=', $this->protocol)
                ->whereNotNull('VW_AGENDA.CONVENIOID')
                ->select(DB::raw("VW_CL_AGENDA_PORTALAGENDA.HORREQID, FORMAT(VW_AGENDA.DATA, 'yyyy-MM-dd') AS DATA, VW_AGENDA.PACIENTEID, VW_AGENDA.NOMEPAC, VW_AGENDA.CONVDESC, VW_CL_AGENDA_PORTALAGENDA.NOME_PROCEDIMENTO, PROCEDIMENTOS.CODIGO, PROCEDIMENTOS.CODTUSS, VW_AGENDA.CONVENIOID"))
                ->get();

            return view('autorizacao::livewire.forms.form-search', ['show_data_protocol' => $protocolos, 'show_data_patient' => $pacientes]);
        }
        else
        {
            $notification = array(
                'message' => 'Protocolo não encontrado',
                'alert-type' => 'error'
            );
            return redirect()->to('autorizacao/nova-solicitacao')->with($notification);
        }
    }
}
