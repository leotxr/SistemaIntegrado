<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetPlan;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetCart;
use Modules\Orcamento\Entities\BudgetStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Modules\Orcamento\Entities\BudgetExam;
use Illuminate\Support\Facades\Auth;
use App\Events\BudgetCreated;

use Modules\Orcamento\Listeners\NotifyBudgetUpdated;
use App\Models\User;
use Modules\Orcamento\Entities\BudgetType;

class CreateBudgetForm extends Component
{
    public Budget $orcamento;
    public BudgetPlan $convenio;
    public $plan;
    public $budget_status_id = 1;
    public $search = '';
    public $exams = [];
    public Collection $selectedExams;
    public $count;
    public $total;
    public $modalExams = false;
    public $modalObservation = false;
    public $modalAlert = false;
    public $budget_type_id = 1;

    protected $rules = [
        'budget_type_id' => 'required',
        'plan' => 'required',
        'orcamento.patient_name' => 'required',
        'orcamento.patient_born_date' => 'max:10',
        'orcamento.patient_phone' => 'required',
        'orcamento.observation' => 'max:220',
        'budget_status_id' => 'required'
    ];

    public function mount()
    {
        $this->orcamento = new Budget();
        $this->selectedExams = collect([]);
        $this->total = 0.0;
        $this->count = 0;
        $this->search = '';
    
    }


    public function selectExam($descricao, $valor, $convenio)
    {
        $cartExam = new BudgetCart(['id' => $this->count + 1, 'exam_name' => $descricao, 'exam_value' => $valor, 'plan_id' => $convenio]);

        $this->selectedExams->push($cartExam);
        $this->total = $this->selectedExams->sum('exam_value');
        $this->count = $this->selectedExams->count();
    }

    public function deselectExam($key)
    {
        $this->selectedExams->forget($key);
        $this->total = $this->selectedExams->sum('exam_value');
        $this->count = $this->selectedExams->count();
    }


    public function save()
    {
        $this->validate();
        $this->orcamento->user_id = Auth::user()->id;
        $this->orcamento->last_user_id = Auth::user()->id;
        $this->orcamento->total_value = $this->total;
        $this->orcamento->budget_date = date('Y-m-d');
        $this->orcamento->budget_status_id = $this->budget_status_id ?? 1;
        $this->orcamento->budget_type_id = $this->budget_type_id;
        $this->orcamento->save();

        foreach ($this->selectedExams as $key => $value) {
            $save = new BudgetExam([
                'name' => $value['exam_name'],
                'budget_id' => $this->orcamento->id,
                'budget_plan_id' => $value['plan_id'],
                'value' => $value['exam_value']
            ]);
            $save->save();
        };
        $this->emitUp('close-modal');
        BudgetCreated::dispatch();
        $this->mount();
 
    }

    public function render()
    {
        
        //$selectplan = BudgetPlan::find($this->plan['id']);

        //if(isset($this->convenio) && $this->convenio->show_values === 0)
        //$this->modalAlert = true;


        if(isset($this->plan))
        {
        $this->convenio = BudgetPlan::findOrFail($this->plan);
        $this->exams = DB::connection('sqlserver')->table('PROCTABELASITENS')
            ->search('PROCEDIMENTOS.DESCRICAO', $this->search)
            ->join('PROCEDIMENTOS', 'PROCTABELASITENS.PROCID', '=', 'PROCEDIMENTOS.PROCID')
            ->join('PROCTABELAS', 'PROCTABELASITENS.PROCTABID', '=', 'PROCTABELAS.PROCTABID')
            ->join('CONVENIOSPLANOS', 'CONVENIOSPLANOS.PROCTABID', '=', 'PROCTABELASITENS.PROCTABID')
            ->where('CONVENIOSPLANOS.PLANOID', $this->convenio->xclinic_id)
            ->select('CONVENIOSPLANOS.PLANODESCRICAO', 'PROCEDIMENTOS.DESCRICAO', 'PROCTABELASITENS.QUANTCH', 'CONVENIOSPLANOS.CONVENIOID')
            ->distinct()
            ->get();
        }

        return view('orcamento::livewire.budget.create-budget-form', [
            'plans' => BudgetPlan::where('active', 1)->get(),
            'exams' => $this->exams,
            'statuses' => BudgetStatus::all(),
            'types' => BudgetType::all()
        ]);
    }
}
