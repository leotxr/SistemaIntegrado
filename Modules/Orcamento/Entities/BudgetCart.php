<?php

namespace Modules\Orcamento\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BudgetCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'exam_name',
        'exam_value',
        'plan_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Orcamento\Database\factories\BudgetCartFactory::new();
    }
}
