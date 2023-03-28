<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'settings_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\CompanyFactory::new();
    }
}
