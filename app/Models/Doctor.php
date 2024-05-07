<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Administrativo\Entities\FinancialInvoice;

class Doctor extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'crm',
        'external_id',
        'user_id',
        'treatment',
        'active',
        'observation'

        ];

    public function invoices()
    {
        return $this->hasMany(FinancialInvoice::class);
    }
}
