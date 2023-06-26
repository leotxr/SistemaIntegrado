<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HelpDesk\Entities\TicketMessage;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requester_id',
        'user_id',
        'ticket_open',
        'ticket_start',
        'ticket_close',
        'ticket_start_pause',
        'ticket_end_pause',
        'status_id',
        'category_id',
        'sub_category_id',
        'priority_id',
        'total_pause',
        'total_ticket'
    ];
    
    public function TicketRequester()
    {
        return $this->belongsTo('App\Models\User', 'requester_id', 'id');
    }

    public function TicketUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function TicketMessages()
    {
        return $this->hasMany(TicketMessage::class);
    }


    public function TicketFiles()
    {
        return $this->hasMany(TicketFile::class);
    }

    public function TicketCategory()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketCategory','category_id', 'id');
    }

    public function TicketSubCategory()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketSubCategory', 'sub_category_id', 'id');
    }

    public function TicketStatus()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketStatus', 'status_id', 'id');
    }




    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketFactory::new();
    }
}
