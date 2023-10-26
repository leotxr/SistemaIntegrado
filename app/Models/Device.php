<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial_number',
        'description',
        'ip_address',
        'mac_address',
        'active',
        'device_type_id',
        'last_response'
    ];
}
