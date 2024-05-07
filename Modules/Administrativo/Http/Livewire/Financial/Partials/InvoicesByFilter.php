<?php

namespace Modules\Administrativo\Http\Livewire\Financial\Partials;

use App\Models\Doctor;
use Livewire\Component;
use Modules\Administrativo\Traits\InvoiceTraits;

class InvoicesByFilter extends Component
{
    use InvoiceTraits;

    public $start_date;
    public $end_date;
    public $selected_doctor = 0;

    public function mount()
    {
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-t');
    }

    public function render()
    {
        return view('administrativo::livewire.financial.partials.invoices-by-filter', [
            'invoices' => $this->getInvoicesByDoctorAndDate($this->selected_doctor, $this->start_date, $this->end_date ),
            'doctors' => Doctor::all()]);
    }
}
