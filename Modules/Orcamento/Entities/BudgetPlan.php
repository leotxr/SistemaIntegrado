<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'active',
        'xclinic_id'
    ];
    
    public function relExams()
    {
        return $this->hasMany(BudgetExam::class);
    }

    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetPlanFactory::new();
    }
}
