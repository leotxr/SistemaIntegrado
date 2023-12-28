<?php

namespace Modules\NC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\NC\Database\factories\NonConformityFactory;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;

class NonConformity extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'description',
        'source_user_id',
        'n_c_status_id',
        'n_c_classification_id',
        'n_c_sector_id',
        'n_c_date'
    ];

    public function targetUsers()
    {
        return $this->belongsToMany(User::class, 'non_conformity_user_sector', 'non_conformity_id', 'user_id');
    }

    public function targetSectors()
    {
        return $this->belongsToMany(UserGroup::class, 'non_conformity_user_sector', 'non_conformity_id', 'user_group_id');
    }

    public function sourceUser()
    {
        return $this->belongsTo(User::class, 'source_user_id', 'id');
    }

    public function classification()
    {
        return $this->belongsTo(NCClassification::class, 'n_c_classification_id', 'id');
    }



    protected static function newFactory(): NonConformityFactory
    {
        return NonConformityFactory::new();
    }
}
