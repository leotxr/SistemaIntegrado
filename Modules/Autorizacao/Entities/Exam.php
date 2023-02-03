<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'exam_date',
        'protocol_id',
        'exam_status',
        'convenio',
        'created_by',
        'updated_by',
        'exam_obs',
        'exam_cod'
    ];
    public function relProtocolExam()
    {
        return $this->belongsTo(Protocol::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamFactory::new();
    }
}
