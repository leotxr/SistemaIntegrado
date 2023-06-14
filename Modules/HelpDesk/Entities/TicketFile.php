<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'ticket_id',
        'user_id'
    ];

    public function FileUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function FileTicket()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\Ticket', 'ticket_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketFileFactory::new();
    }
}
