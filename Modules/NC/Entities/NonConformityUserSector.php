<?php

namespace Modules\NC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\NC\Database\factories\NonConformityUserSectorFactory;
use App\Models\User;
use App\Models\UserGroup;

class NonConformityUserSector extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'non_conformity_id',
        'user_id',
        'user_group_id'

    ];



    protected static function newFactory(): NonConformityUserSectorFactory
    {
        //return NonConformityUserSectorFactory::new();
    }
}
