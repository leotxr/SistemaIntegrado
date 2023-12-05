<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'exam_date',
        'protocol_id',
        'exam_status',
        'exam_status_id',
        'convenio',
        'created_by',
        'updated_by',
        'exam_obs',
        'exam_cod'
    ];
    public function relProtocolExam()
    {
        return $this->belongsTo('Modules\Autorizacao\Entities\Protocol', 'protocol_id', 'id');
    }
    public function relExamStatus()
    {
        return $this->hasOne('Modules\Autorizacao\Entities\ExamStatus', 'id');
    }

    public function protocol()
    {
        return $this->belongsTo(Protocol::class, 'protocol_id', 'id');
    }
    public function examStatus()
    {
        return $this->belongsTo(ExamStatus::class, 'exam_status_id', 'id');
    }
    public function userUpdateExam()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamFactory::new();
    }
}
