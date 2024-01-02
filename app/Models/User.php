<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Administrativo\Entities\ExtraTime;
use Modules\NC\Entities\NonConformity;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;
use Modules\Orcamento\Entities\Budget;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Protocol;

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

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'user_id');
    }

    public function updateProtocol()
    {
        return $this->hasMany(Protocol::class, 'updated_by');
    }

    public function updateExam()
    {
        return $this->hasMany(Exam::class, 'updated_by');
    }

    public function changedBudgets()
    {
        return $this->hasMany(Budget::class, 'last_user_id');
    }

    public function nonConformities()
    {
        return $this->belongsToMany(NonConformity::class, 'non_conformity_user_sector', 'user_id', 'non_conformity_id');
    }


}
