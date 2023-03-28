<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'mensagem',
        'user_id'
    ];

    public function relMessageTicket()
    {
        return $this->hasOne('Modules\HelpDesk\Entities\Ticket', 'id', 'ticket_id');
    }

    public function relMessageUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketMessageFactory::new();
    }
}
