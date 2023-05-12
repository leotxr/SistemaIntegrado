<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_id',
        'description'
    ];


    public function relSector()
    {
        return $this->belongsTo(Sector::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\QuestionFactory::new();
    }
}
