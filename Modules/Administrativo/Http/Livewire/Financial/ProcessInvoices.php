<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use App\Models\Doctor;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Administrativo\Entities\FinancialInvoice;
use Modules\Administrativo\Exports\Financial\DiscountExamsExport;

class ProcessInvoices extends Component
{
    public $doctors;
    public $selected_doctor = '';
    public $selected_invoices = [];
    public $invoices_discount;
    public $invoices_payment;
    public $total_value_invoices = 0;
    public $payment_value = 0;
    public $discount_value = 0;

    public $liquid_payment_value = 0;
    public $liquid_discount_value = 0;

    public $start_date;
    public $end_date;
    public $discount_percent;
    public $payment_percent;
    public $CheckAllInvoices = false;

    protected $rules = [
        'discount_percent' => 'required',
        'payment_percent' => 'required',
        'invoices_discount' => 'required',
        'invoices_payment' => 'required'
    ];

    public function mount()
    {
        $this->doctors = Doctor::all();
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-t');

    }

    public function getInvoices()
    {
        return FinancialInvoice::where('doctor_id', $this->selected_doctor)->whereBetween('exam_date', [$this->start_date, $this->end_date])->get();
    }

    public function calcDiscount()
    {
        $this->reset('discount_value');
        $this->invoices_discount = $this->getInvoices();
        foreach ($this->invoices_discount as $discount) {
            $this->discount_value += $discount->total_value;
        }
        /*
        foreach ($this->selected_invoices as $selected_invoice) {
            $invoice = FinancialInvoice::find($selected_invoice);
            $this->total_value_invoices += $invoice->total_value;
        }
        */
        $this->liquid_discount_value = ($this->discount_value * $this->discount_percent) / 100;


    }

    public function calcPayment()
    {
        $this->reset('payment_value');
        $this->invoices_payment = $this->getInvoices()->where('payment_enable', true);
        foreach ($this->invoices_payment as $payment) {
            $this->payment_value += $payment->total_value;
        }
        $this->liquid_payment_value = ($this->payment_value * $this->payment_percent) / 100;
    }

    public function updatedCheckAllInvoices($value)
    {
        if ($value) {
            $this->selected_invoices = array_column($this->getInvoices()->toArray(), 'id');
            $this->select();
        } else
            $this->selected_invoices = [];
    }

    public function exportInvoices()
    {
        $this->validate();
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'doctor' => $this->selected_doctor,
            'invoices' => $this->invoices_discount,
            'discount_value' => $this->discount_value,
            'liquid_discount_value' => $this->liquid_discount_value,
            'discount_percent' => $this->discount_percent,
            'invoices_payment' => $this->invoices_payment,
            'payment_value' => $this->payment_value,
            'liquid_payment_value' => $this->liquid_payment_value,
            'payment_percent' => $this->payment_percent

        ];
        return Excel::download(new DiscountExamsExport($range), 'desconto-exames-' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function exportInvoicesPDF()
    {
        $pdf = PDF::loadView('administrativo::financial.exports.pdf-discount-exams-export',
            ['start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'doctor' => $this->selected_doctor,
                'invoices' => $this->invoices_discount,
                'discount_value' => $this->discount_value,
                'liquid_discount_value' => $this->liquid_discount_value,
                'discount_percent' => $this->discount_percent,
                'invoices_payment' => $this->invoices_payment,
                'payment_value' => $this->payment_value,
                'liquid_payment_value' => $this->liquid_payment_value,
                'payment_percent' => $this->payment_percent]);
        return $pdf->download('invoice.pdf');

    }

    public function render()
    {
        return view('administrativo::livewire.financial.process-invoices', ['invoices' => $this->getInvoices()]);
    }
}
