<?php

namespace Modules\HelpDesk\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExtraService extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'sector',
        'requester_id',
        'user_id',
        'is_ticket',
        'item',
        'action',
        'status_id'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'status_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\ExtraServiceFactory::new();
    }
}
