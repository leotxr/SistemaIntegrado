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
        'ticket_id',
        'user_id'
    ];

    public function MessageUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


    public function MessageTicket()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\Ticket', 'ticket_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketMessageFactory::new();
    }
}
