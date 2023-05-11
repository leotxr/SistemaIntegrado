<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Protocol extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_name', 
        'paciente_id',
        'observacao',
        'autorizado',
        'created_by',
        'updated_by',
    ];
    public function relPhotos()
    {
        return $this->hasMany(Photo::class);
    }

    public function relExams()
    {
        return $this->hasMany(Exam::class);
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
        return \Modules\Autorizacao\Database\factories\ProtocolFactory::new();
    }
}
