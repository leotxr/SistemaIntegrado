<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order'
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'status_id', 'id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(ExtraService::class, 'status_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketStatusFactory::new();
    }
}
