<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order',
        'ticket_category_id',
        'priority_id'
    ];
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketSubCategoryFactory::new();
    }
}
