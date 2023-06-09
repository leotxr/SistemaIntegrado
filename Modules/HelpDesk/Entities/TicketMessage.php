<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'read',
        'ticket_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketMessageFactory::new();
    }
}
