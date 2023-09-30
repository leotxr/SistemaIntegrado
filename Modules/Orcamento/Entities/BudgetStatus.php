<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description',
        'color',
        'type_id'
    ];

    public function statusBudget()
    {
        return $this->hasMany(Budget::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetStatusFactory::new();
    }
}
