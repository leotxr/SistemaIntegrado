<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use Livewire\Component;
use Modules\Orcamento\Entities\BudgetPlan;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Modules\Orcamento\Entities\BudgetExam;

class CreateBudgetForm extends Component
{
    public Budget $orcamento;
    public BudgetPlan $convenio;
    public $plan = 1;
    public $search = '';
    public $exams = [];
    public Collection $selectedExams;
    public $count = 0;
    public $total = 0.0;
    public $modalExams = false;

    protected $rules = [
        'plan' => 'required',
        'orcamento.patient_name' => 'required',
        'orcamento.patient_born_date' => 'required',
        'orcamento.patient_phone' => 'required'
    ];

    public function mount()
    {
        $this->orcamento = new Budget();
        $this->selectedExams = collect([]);
        
    }

    public function selectExam($descricao, $valor, $convenio)
    {
        $cartExam = new BudgetCart(['id' => $this->count + 1, 'exam_name' => $descricao, 'exam_value' => $valor, 'plan_id' => $convenio]);

        $this->selectedExams->push($cartExam);
        $this->total = $this->selectedExams->sum('exam_value');
        $this->count = $this->selectedExams->count();
    }

    public function showSelectedExams()
    {
        $this->modalExams = true;
    }

    public function deselectExam($key)
    {
        $this->selectedExams->forget($key);
        $this->total = $this->selectedExams->sum('exam_value');
        $this->count = $this->selectedExams->count();
    }

    public function unsetCollection()
    {
        $this->selectedExams = collect([]);
        $this->total = $this->selectedExams->sum('exam_value');
    }

    public function save()
    {
        $this->validate();
        $this->orcamento->total_value = $this->total;
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

        unset($this->orcamento);
        $this->emitUp('closeModal');
        $this->render();
    }

    public function render()
    {
        $this->convenio = BudgetPlan::findOrFail($this->plan);
        //$selectplan = BudgetPlan::find($this->plan['id']);

        $this->exams = DB::connection('sqlserver')->table('PROCTABELASITENS')
            ->search('PROCEDIMENTOS.DESCRICAO', $this->search)
            ->join('PROCEDIMENTOS', 'PROCTABELASITENS.PROCID', '=', 'PROCEDIMENTOS.PROCID')
            ->join('PROCTABELAS', 'PROCTABELASITENS.PROCTABID', '=', 'PROCTABELAS.PROCTABID')
            ->join('CONVENIOSPLANOS', 'CONVENIOSPLANOS.PROCTABID', '=', 'PROCTABELASITENS.PROCTABID')
            ->where('CONVENIOSPLANOS.PLANODESCRICAO', $this->convenio->name)
            ->select('CONVENIOSPLANOS.PLANODESCRICAO', 'PROCEDIMENTOS.DESCRICAO', 'PROCTABELASITENS.QUANTCH', 'CONVENIOSPLANOS.CONVENIOID')
            ->distinct()
            ->get();



        return view('orcamento::livewire.budget.create-budget-form', [
            'plans' => BudgetPlan::where('active', 1)->get(),
            'exams' => $this->exams,
        ]);
    }
}
