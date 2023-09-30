<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_born_date',
        'patient_phone',
        'discount',
        'total_value',
        'initial_status_id',
        'user_id',
        'budget_status_id',
        'last_user_id',
        'budget_type_id',
        'budget_date'
    ];

    public function relExams()
    {
        return $this->hasMany(BudgetExam::class);
    }

    public function relStatus()
    {
        return $this->belongsTo(BudgetStatus::class, 'budget_status_id', 'id');
    }

    public function initialStatus()
    {
        return $this->belongsTo(BudgetStatus::class, 'initial_status_id', 'id');
    }

    public function relBudgetType()
    {
        return $this->belongsTo(BudgetType::class, 'budget_type_id', 'id');
    }

    public function lastUser()
    {
        return $this->belongsTo(User::class, 'last_user_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetFactory::new();
    }
}
