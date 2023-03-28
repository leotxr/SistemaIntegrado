<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
    ];
    
    public function relSubCategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\CategoryFactory::new();
    }
}
