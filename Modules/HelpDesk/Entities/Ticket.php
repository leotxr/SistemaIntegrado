<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requester_id',
        'user_id',
        'ticket_open',
        'ticket_close',
        'ticket_start_pause',
        'ticket_end_pause',
        'status_id',
        'category_id',
        'sub_category_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketFactory::new();
    }
}
