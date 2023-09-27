<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Administrativo\Entities\ExtraTime;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;
use Modules\Orcamento\Entities\Budget;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'user_group_id',
        'email',
        'password',
        'profile_img',
        'signature'
    ];

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userPermission()
    {
        return $this->belongsTo(Permission::class, 'model_has_permissions', 'model_id', 'permission_id');
    }

    public function relUserGroup()
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id', 'id');
    }

    public function relExtraTimes()
    {
        return $this->hasMany(ExtraTime::class, 'user_id');
    }

    public function relMissedTimes()
    {
        return $this->hasMany(MissedTime::class, 'user_id');
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'user_id');
    }
    
    
}
