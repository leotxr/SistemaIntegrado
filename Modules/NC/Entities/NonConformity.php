<?php

namespace Modules\NC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\NC\Database\factories\NonConformityFactory;
use App\Models\User;
use App\Models\UserGroup;

class NonConformity extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'description',
        'source_user_id',
        'target_user_id',
        'n_c_status_id',
        'n_c_classification_id',
        'n_c_sector_id',
        'n_c_date'
    ];

    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id', 'id');
    }

    public function sourceUser()
    {
        return $this->belongsTo(User::class, 'source_user_id', 'id');
    }

    public function classification()
    {
        return $this->belongsTo(NCClassification::class, 'n_c_classification_id', 'id');
    }

    public function envolvedSector()
    {
        return $this->belongsTo(UserGroup::class, 'n_c_sector_id', 'id');
    }

    protected static function newFactory(): NonConformityFactory
    {
        return NonConformityFactory::new();
    }
}
