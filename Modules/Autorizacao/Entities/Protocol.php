<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protocol extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'paciente_name', 
        'paciente_id',
        'observacao',
        'recebido',
        'created_by',
        'updated_by',
        'user_id'
    ];
    public function relPhotos()
    {
        return $this->hasMany(Photo::class);
    }
    public function relExams()
    {
        return $this->hasMany(Exam::class);
    }
    public function relExamStatus()
    {
        return $this->hasOne('Modules\Autorizacao\Entities\ExamStatus', 'id');
    }
    public function relUserProtocol()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ProtocolFactory::new();
    }
}
