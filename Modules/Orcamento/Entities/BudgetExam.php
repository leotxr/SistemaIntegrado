<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'budget_id',
        'budget_plan_id',
        'discount',
        'value',
        'final_value'
        
    ];

    public function ExamBudget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function ExamPlan()
    {
        return $this->belongsTo(BudgetPlan::class, 'budget_plan_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetExamFactory::new();
    }
}
