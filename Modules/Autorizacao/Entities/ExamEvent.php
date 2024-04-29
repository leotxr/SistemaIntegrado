<?php

namespace Modules\Autorizacao\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'order_to_show',
        'color',
        'icon',
        'active'
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_event_users')->withPivot('observation');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'exam_event_user');
    }

    protected static function newFactory()
    {
        return \Modules\Autorizacao\Database\factories\ExamEventFactory::new();
    }
}
