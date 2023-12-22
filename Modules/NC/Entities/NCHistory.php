<?php

namespace Modules\NC\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\NC\Database\factories\NCHistoryFactory;
use App\Models\User;

class NCHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'non_conformity_id',
        'changed_field',
        'old_value',
        'new_value',
        'updated_by'
    ];

    public function nonConformity()
    {
        return $this->belongsTo(NonConformity::class, 'non_conformity_id', 'id');
    }

    public function userHistory()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    protected static function newFactory(): NCHistoryFactory
    {
        return NCHistoryFactory::new();
    }
}
