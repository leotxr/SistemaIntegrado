<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketPause extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_pause',
        'end_pause',
        'user_id',
        'ticket_id',
        'ticket_message_id'
    ];


    public function PauseTicket()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\Ticket', 'ticket_id', 'id');
    }

    public function PauseMessage()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketMessage', 'ticket_message_id', 'id');
    }

    public function PauseUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketPauseFactory::new();
    }
}
