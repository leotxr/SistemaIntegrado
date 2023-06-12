<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order',
        'priority_id'
    ];

    public function relPriority()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketPriority', 'priority_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketCategoryFactory::new();
    }
}
