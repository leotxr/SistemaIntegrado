<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketPriority extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order'
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketPriorityFactory::new();
    }
}
