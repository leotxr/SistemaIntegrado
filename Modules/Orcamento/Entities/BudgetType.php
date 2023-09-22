<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'color'
    ];
    
    public function relBudgets()
    {
        return $this->hasMany(Budget::class);
    }

    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetTypeFactory::new();
    }
}
