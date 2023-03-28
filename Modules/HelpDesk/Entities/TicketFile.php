<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'url'
    ];

    public function relFileTicket()
    {
        return $this->hasOne(Ticket::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketFileFactory::new();
    }

    
}
