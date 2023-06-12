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
        'ticket_category_id'
    ];

    public function relCategory()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketCategory', 'ticket_category_id', 'id');
    }

    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketSubCategoryFactory::new();
    }
}
