<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description'
    ];
    

    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\FileTypeFactory::new();
    }
}
