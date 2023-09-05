<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_born_date',
        'patient_phone',
        'discount',
        'total_value',
        'budget_status_id'
    ];

    public function relExams()
    {
        return $this->hasMany(BudgetExam::class);
    }

    public function relStatus()
    {
        return $this->belongsTo(BudgetStatus::class, 'budget_status_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetFactory::new();
    }
}
