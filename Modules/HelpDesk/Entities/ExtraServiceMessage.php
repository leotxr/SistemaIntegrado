<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExtraServiceMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'read',
        'extra_service_id',
        'user_id',
        'is_final_action'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }


    public function extraService()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\ExtraService', 'extra_service_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\ExtraServiceMessageFactory::new();
    }
}
