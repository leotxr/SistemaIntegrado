<?php

namespace Modules\NC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\NC\Database\factories\NCClassificationFactory;

class NCClassification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'active',
        'color'
    ];

    protected static function newFactory(): NCClassificationFactory
    {
        return NCClassificationFactory::new();
    }
}
