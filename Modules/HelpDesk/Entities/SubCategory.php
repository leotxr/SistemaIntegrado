<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'category_id'
    ];
    

    public function relCategory()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\SubCategoryFactory::new();
    }
}
