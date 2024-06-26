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

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamStatusFactory::new();
    }
}
