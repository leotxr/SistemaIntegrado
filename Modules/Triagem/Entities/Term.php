<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'patient_id',
        'patient_name',
        'patient_age',
        'proced',
        'start_hour',
        'final_hour',
        'exam_date',
        'contrast',
        'time_spent',
        'observation'
    ];

    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\TermFactory::new();
    }
}
