<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

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
    public function Photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function requester()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function updater()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ProtocolFactory::new();
    }
}
