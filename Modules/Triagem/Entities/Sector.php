<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'xclinic_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\SectorFactory::new();
    }
}
