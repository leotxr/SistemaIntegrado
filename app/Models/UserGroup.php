<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\NC\Entities\NonConformity;

class UserGroup extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
    use HasFactory;


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function groupNonConformities()
    {
        return $this->belongsToMany(NonConformity::class, 'non_conformity_user_sector', 'user_group_id', 'non_conformity_id');
    }
}
