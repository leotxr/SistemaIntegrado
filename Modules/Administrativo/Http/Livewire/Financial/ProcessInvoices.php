<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use App\Models\Doctor;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Administrativo\Entities\FinancialInvoice;
use Modules\Administrativo\Exports\Financial\DiscountExamsExport;

class ProcessInvoices extends Component
{
    public $doctors;
    public $selected_doctor = '';
    public $selected_invoices = [];
    public $total_invoices = 0;
    public $total_value_invoices = 0;
    public $liquid_value_invoices = 0;
    public $start_date = '2024-03-01';
    public $end_date = '2024-03-14';
    public $percent;
    public $CheckAllInvoices = false;

    public function mount()
    {
        $this->doctors = Doctor::all();

    }

    public function getInvoices()
    {
        return FinancialInvoice::where('doctor_id', $this->selected_doctor)->whereBetween('exam_date', [$this->start_date, $this->end_date])->get();
    }

    public function select()
    {
        $this->reset('total_value_invoices', 'liquid_value_invoices');
        foreach ($this->selected_invoices as $selected_invoice) {
            $invoice = FinancialInvoice::find($selected_invoice);
            $this->total_value_invoices += $invoice->total_value;
        }
        $this->liquid_value_invoices = ($this->total_value_invoices * $this->percent)/100;
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
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'doctor' => $this->selected_doctor,
        ];
        return Excel::download(new DiscountExamsExport($range), 'desconto-exames-' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function exportInvoicesPDF()
    {
        $pdf = PDF::loadView('administrativo::financial.exports.discount-exams-export', ['start' => $this->start_date, 'end' => $this->end_date, 'doctor' => $this->selected_doctor]);
        return $pdf->download('desconto-exames-' . $this->start_date . '-' . $this->end_date . '.pdf');
    }

    public function render()
    {
        return view('administrativo::livewire.financial.process-invoices', ['invoices' => $this->getInvoices()]);
    }
}
