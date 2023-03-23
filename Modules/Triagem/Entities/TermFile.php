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
        'file_type_id'
    ];

    public function relTerms()
    {
        return $this->hasOne(Term::class);
    }

    public function relTypes()
    {
        return $this->hasOne('Modules\Triagem\Entities\FileType', 'id', 'file_type_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\TermFileFactory::new();
    }
}
