<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'status_cor'
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\StatusFactory::new();
    }
}
