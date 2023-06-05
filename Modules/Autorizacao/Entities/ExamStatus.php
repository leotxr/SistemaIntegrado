<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order_to_show'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamStatusFactory::new();
    }
}
