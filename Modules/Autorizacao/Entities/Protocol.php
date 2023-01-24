<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Protocol extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_name', 
        'paciente_id',
        'observacao'
    ];
    public function relPhotos()
    {
        return $this->hasMany(Photo::class);
    }
    public function relExams()
    {
        return $this->hasMany(Exam::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ProtocolFactory::new();
    }
}
