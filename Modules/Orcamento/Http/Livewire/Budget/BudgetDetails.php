<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetExam;
use Modules\Orcamento\Events\BudgetUpdated;

class BudgetDetails extends Component
{
    public Budget $orcamento;
    public $exams;

    protected $rules = 
    [
        'orcamento.patient_name' => 'required',
        'orcamento.patient_born_date' => 'required',
        'orcamento.patient_phone' => 'required'
        
        
    ];

    public function mount(Budget $orcamento)
    {
        $this->orcamento = $orcamento;
        //$this->exams = BudgetExam::where('budget_id', $this->orcamento->id)->get();
    }

    public function markScheduled(Budget $orcamento)
    {
        $this->orcamento = $orcamento;
        $this->orcamento->scheduled === 0 ? $this->orcamento->scheduled = 1 : $this->orcamento->scheduled = 0;
        $this->orcamento->save();
        BudgetUpdated::dispatch();
        //$this->emitUp('budget-updated');
    }

    public function render()
    {
        return view('orcamento::livewire.budget.budget-details');
    }
}
