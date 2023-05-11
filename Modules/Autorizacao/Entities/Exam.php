<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Autorizacao\Entities\Protocol;

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

    public function relProtocol()
    {
        return $this->belongsTo(Protocol::class, 'protocol_id');
    }

    public function relUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function lastUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamFactory::new();
    }
}
