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
    
    public function TicketRequester()
    {
        return $this->belongsTo('App\Models\User', 'requester_id', 'id');
    }

    public function TicketUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function TicketCategory()
    {
        return $this->hasOne('Modules\HelpDesk\Entities\TicketCategory', 'id');
    }

    public function TicketSubCategory()
    {
        return $this->hasOne('Modules\HelpDesk\Entities\TicketSubCategory', 'id');
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
