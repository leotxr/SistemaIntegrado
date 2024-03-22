<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use App\Models\Doctor;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Administrativo\Entities\FinancialInvoice;
use App\Models\User;
use Modules\Administrativo\Exports\Financial\DiscountExamsExport;
use Modules\Laudo\Exports\ExamsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ShowInvoices extends Component
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
        return FinancialInvoice::orderBy('id', 'desc')->take(5)->get();
    }


    public function render()
    {
        return view('administrativo::livewire.financial.show-invoices', ['invoices' => $this->getInvoices()]);
    }
}
