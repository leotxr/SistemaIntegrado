<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;
use Modules\Orcamento\Entities\BudgetType;
use App\Events\BudgetCreated;
use Illuminate\Support\Facades\Auth;

class BudgetDetails extends Component
{
    public Budget $orcamento;
    public $exams;
    public $modalObservation = false;

    protected $rules = 
    [
        'orcamento.budget_status_id' => 'required',
        'orcamento.patient_name' => 'required',
        'orcamento.patient_born_date' => 'max:10',
        'orcamento.patient_phone' => 'required',
        'orcamento.observation' => 'max:220',
        'orcamento.budget_type_id' => 'required'
        
        
    ];

    public function mount(Budget $orcamento)
    {
        $this->orcamento = $orcamento;
        //$this->exams = BudgetExam::where('budget_id', $this->orcamento->id)->get();
    }

    public function update()
    {
        $this->validate(
            [
                'orcamento.budget_status_id' => 'required'
            ]
        );
        $this->orcamento->last_user_id = Auth::user()->id;
        $this->orcamento->save();
        BudgetCreated::dispatch();
        //$this->emitUp('budget-updated');
        $this->emitUp('close-modal');
        $this->render();
    }

    public function showObservation(Budget $orcamento)
    {
        $this->orcamento = $orcamento;
        $this->modalObservation = true;
    }

    public function render()
    {
        return view('orcamento::livewire.budget.budget-details', ['statuses' => BudgetStatus::whereIn('type_id', [2, 3])->orderBy('id', 'DESC')->get(), 'types' => BudgetType::all()]);
    }
}
