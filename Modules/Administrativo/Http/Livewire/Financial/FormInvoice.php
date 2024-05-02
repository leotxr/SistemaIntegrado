<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Administrativo\Entities\FinancialInvoice;
use Illuminate\Support\Facades\Auth;


class FormInvoice extends Component
{
    public $invoice_id;
    public $invoice;
    public $payment_enable = true;


    protected $listeners = [
        'searchInvoice' => 'searchInvoiceData'
    ];

    protected $rules = [
        'invoice.*' => 'required',
        'invoice.payment_enable' => 'boolean'
    ];

    public function mount()
    {
        //$this->invoice = new FinancialInvoice();
        //$this->saving_invoice = new FinancialInvoice();
    }

    public function getInvoice($invoice_id)
    {

        return DB::connection('sqlserver')->table('FATURA')
            ->join('PACIENTE', 'PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
            ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->join('CONVENIOS', 'CONVENIOS.CONVENIOID', '=', 'FATURA.CONVENIOID')
            ->join('MEDICOS', 'MEDICOS.MEDICOID', '=', 'FATURA.MEDREAID')
            ->where('FATURA.FATURAID', $invoice_id)
            ->selectRaw('FATURA.DATA AS DATA,
            FATURA.FATURAID AS FATURA,
            PACIENTE.NOME AS PACIENTE,
            PACIENTE.PACIENTEID AS PACIENTE_ID,
            PROCEDIMENTOS.DESCRICAO AS PROCEDIMENTO,
            CONVENIOS.DESCRICAO AS CONVENIO,
            MEDICOS.NOME AS MEDICO,
            MEDICOS.MEDICOID AS MEDICO_ID,
            FATURA.VAL_CH + FATURA.VAL_CO + FATURA.VAL_FIL + FATURA.VAL_MAT AS VALOR_CONVENIO,
            FATURA.VALPARTCH + FATURA.VALPARTCO AS VALOR_PAGO')->first();
    }

    public function searchInvoiceData($invoice_id)
    {

        $this->invoice_id = $invoice_id;
        if (!$this->getInvoice($this->invoice_id)) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Código de Fatura não encontrado.']
            );
        } else {
            $query = $this->getInvoice($this->invoice_id);

            $this->invoice = new FinancialInvoice();
            $this->invoice->payment_enable = true;
            $this->invoice->invoice_id = $query->FATURA;
            $this->invoice->patient_id = $query->PACIENTE_ID;
            $this->invoice->patient_name = $query->PACIENTE;
            $this->invoice->exam_id = $invoice_id;
            $this->invoice->exam_description = $query->PROCEDIMENTO;
            $this->invoice->exam_date = $query->DATA;
            $this->invoice->insurance = $query->CONVENIO;
            $this->invoice->doctor = $query->MEDICO;
            $this->invoice->doctor_id = $query->MEDICO_ID;
            $this->invoice->paid_insurance = $query->VALOR_CONVENIO;
            $this->invoice->paid_patient = $query->VALOR_PAGO;
            $this->invoice->total_value = $this->invoice->paid_insurance + $this->invoice->paid_patient;
            $this->invoice->processed = 0;
            $this->invoice->requester_id = Auth::user()->id;
        }
    }

    public function saveInvoice()
    {
        if ($this->invoice->save()) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Fatura enviada para processamento!']
            );
            $this->reset();
            $this->emit('clearInvoiceId');
        } else {

            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao enviar a fatura.']
            );
        }

    }


    public function render()
    {

        return view('administrativo::livewire.financial.form-invoice');
    }
}
