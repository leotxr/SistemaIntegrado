<?php

namespace Modules\Administrativo\Entities;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'patient_id',
        'patient_name',
        'exam_id',
        'exam_description',
        'exam_date',
        'insurance',
        'doctor',
        'paid_insurance',
        'paid_patient',
        'total_value',
        'processed',
        'payment_enable',
        'requester_id',
        'user_id'
    ];

    public function financialDoctor()
    {
       return $this->belongsTo(Doctor::class);
    }

    protected static function newFactory()
    {
        return \Modules\Administrativo\Database\factories\FinancialInvoiceFactory::new();
    }
}
