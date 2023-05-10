<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'patient_id',
        'patient_name',
        'patient_age',
        'proced',
        'start_hour',
        'final_hour',
        'exam_date',
        'contrast',
        'contrast_term',
        'tele_report',
        'signed',
        'time_spent',
        'sector_id',
        'observation',
        'finished'
    ];

    public function relTermFiles()
    {
        return $this->hasMany(TermFile::class);
    }

    public function relSector()
    {
        return $this->belongsTo(Sector::class);
    }

    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\TermFactory::new();
    }
}
