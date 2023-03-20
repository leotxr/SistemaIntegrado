<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TermFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'term_id',
        'url',
    ];

    public function relTerms()
    {
        return $this->hasMany(Term::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\TermFileFactory::new();
    }
}
