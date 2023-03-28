<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\SectorFactory::new();
    }
}
