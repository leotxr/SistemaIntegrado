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

    public function categories()
    {
        return $this->hasMany(TicketCategory::class);
    }

    public function countTickets($id)
    {
        return Ticket::join('ticket_categories', 'tickets.category_id',
            '=', 'ticket_categories.id')
            ->join('ticket_priorities', 'ticket_categories.priority_id', '=', 'ticket_priorities.id')
            ->where('ticket_priorities.id', $id)
            ->whereNot('tickets.status_id', 2)
            ->count();
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketPriorityFactory::new();
    }
}
