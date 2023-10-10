<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
