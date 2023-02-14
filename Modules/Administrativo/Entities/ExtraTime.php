<?php

namespace Modules\Administrativo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class ExtraTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'data',
        'tempo',
        'motivo',
        'reason_id',
        'justificativa',
        'observacao'
    ];

    public function relUsers()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function relReasons()
    {
        return $this->hasOne('Modules\Administrativo\Entities\Reason', 'id', 'reason_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Administrativo\Database\factories\ExtraTimeFactory::new();
    }
}
