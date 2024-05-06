<?php

namespace Modules\Administrativo\Http\Livewire\Financial\Partials;

use Livewire\Component;
use Modules\Administrativo\Traits\InvoiceTraits;

class InvoicesByFilter extends Component
{
    use InvoiceTraits;

    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-t');
    }
    public function render()
    {
        return view('administrativo::livewire.financial.partials.invoices-by-filter', [
            'invoices' => $this->getInvoicesByDoctorAndDate(1, $this->start_date, $this->end_date )]);
    }
}
