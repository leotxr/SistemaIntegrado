<?php

namespace Modules\Administrativo\Http\Livewire\Financial\Partials;

use App\Models\Doctor;
use Livewire\Component;

class ChartInvoicesMonth extends Component
{
    public $doctors = [];
    public $invoices_by_doctor = [];

    public function mount()
    {
        $doctors = Doctor::all();
        foreach($doctors as $doctor){
            $this->doctors[] = $doctor->name;
            $this->invoices_by_doctor[] = $doctor->invoices->count() ?? 0;
        }

    }


    public function render()
    {
        return view('administrativo::livewire.financial.partials.chart-invoices-month');
    }
}
