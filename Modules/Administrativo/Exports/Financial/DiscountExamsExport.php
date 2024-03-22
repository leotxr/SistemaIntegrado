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

    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
        $this->doctor = $range['doctor'];
    }

    public function getInvoices()
    {
        return FinancialInvoice::where('doctor_id', $this->doctor)->whereBetween('exam_date', [$this->start, $this->end])->get();
    }
    public function view(): View
    {
        return view(
            'administrativo::financial.exports.discount-exams-export',
            ['query' => $this->getInvoices()]
        );
    }
}
