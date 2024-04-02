<?php

namespace Modules\Administrativo\Exports\Financial;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Administrativo\Entities\FinancialInvoice;

class DiscountExamsExport implements FromView
{
    use Exportable;

    public $start;
    public $end;
    public $doctor;
    public $invoices;
    public $discount_value;
    public $liquid_discount_value;
    public $discount_percent;
    public $invoices_payment;
    public $payment_value;
    public $liquid_payment_value;
    public $payment_percent;

    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
        $this->doctor = $range['doctor'];
        $this->invoices = $range['invoices'];
        $this->discount_value = $range['discount_value'];
        $this->liquid_discount_value = $range['liquid_discount_value'];
        $this->discount_percent = $range['discount_percent'];
        $this->invoices_payment = $range['invoices_payment'];
        $this->payment_value = $range['payment_value'];
        $this->liquid_payment_value = $range['liquid_payment_value'];
        $this->payment_percent = $range['payment_percent'];

    }

    public function getInvoices()
    {
        return FinancialInvoice::where('doctor_id', $this->doctor)->whereBetween('exam_date', [$this->start, $this->end])->get();
    }

    public function view(): View
    {
        return view(
            'administrativo::financial.exports.discount-exams-export',
            ['start_date' => $this->start,
                'end_date' => $this->end,
                'doctor' => $this->doctor,
                'query' => $this->invoices,
                'discount_value' => $this->discount_value,
                'liquid_discount_value' => $this->liquid_discount_value,
                'discount_percent' => $this->discount_percent,
                'invoices_payment' => $this->invoices_payment,
                'payment_value' => $this->payment_value,
                'liquid_payment_value' => $this->liquid_payment_value,
                'payment_percent' => $this->payment_percent]
        );
    }
}
