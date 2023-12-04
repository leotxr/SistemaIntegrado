<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Autorizacao\Database\factories\ProtocolInUseFactory;

class ProtocolInUse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'protocol_id',
        'expires_at'
    ];

    public function usedBy()
    {
        return $this->hasOne('App\Models\User' );
    }

    public function hasProtocol()
    {
        return $this->hasOne(Protocol::class);
    }

    protected static function newFactory(): ProtocolInUseFactory
    {
        //return ProtocolInUseFactory::new();
    }
}
