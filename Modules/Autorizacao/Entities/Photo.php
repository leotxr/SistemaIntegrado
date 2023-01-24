<?php

namespace Modules\Autorizacao\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';
    protected $fillable = [
        'url', 
        'protocol_id'
    ];
    public function relProtocol()
    {
        return $this->belongsTo(Protocol::class);
    }

    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\PhotoFactory::new();
    }
}
