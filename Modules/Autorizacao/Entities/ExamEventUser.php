<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamEventUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'exam_event_id',
        'user_id',
        'observation'
    ];

    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamEventUserFactory::new();
    }
}
