<?php

namespace Modules\Administrativo\Traits;

use Illuminate\Support\Facades\DB;
use Modules\Administrativo\Entities\FinancialInvoice;
trait InvoiceTraits
{
    public function getXClinicInvoice($invoice_id) // Retorna a fatura buscada no X-clinic através da FATURAID
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
    public function getInvoicesByDoctorAndDate($selected_doctor, $start_date, $end_date)
    {
        return FinancialInvoice::where('doctor_id', $this->selected_doctor)->whereBetween('exam_date', [$this->start_date, $this->end_date])->get();
    }

    public function getNInvoices($value)
    {
        return FinancialInvoice::orderBy('id', 'desc')->take($value)->get(); //Retorna as últimas N faturas inseridas
    }


}