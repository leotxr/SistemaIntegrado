<?php

namespace Modules\Administrativo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reason extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'desc'
    ];

    public function relExtraTimes()
    {
        return $this->hasMany(ExtraTime::class);
    }

    public function relMissedTimes()
    {
        return $this->hasMany(MissedTime::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Administrativo\Database\factories\ReasonFactory::new();
    }
}
