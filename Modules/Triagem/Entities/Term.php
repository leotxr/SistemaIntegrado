<?php

namespace Modules\Triagem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PDOException;

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
        'exam_hour',
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

    public function relUserTerm()
    {
        return $this->belongsTo('App\Models\user', 'user_id', 'id');
    }

    public static function getTermsByDate($data, $type = 'query')
    {
        try {
            $terms = self::whereIn('sector_id', $data['sectors'])
                ->whereBetween('exam_date', [$data['startDate'], $data['endDate']])
                ->whereIn('user_id', $data['nurses'])
                ->join('users as u', 'u.id', '=', 'terms.user_id')
                ->select(
                    'terms.exam_date as DATA_EXAME',
                    'terms.patient_name as PACIENTE',
                    'terms.proced as EXAME',
                    'u.id as USUARIO_ID',
                    'u.name as USUARIO',
                    'terms.start_hour as INICIO',
                    'terms.final_hour as FIM',
                    \DB::raw('TIMEDIFF(terms.final_hour, terms.start_hour) AS TEMPO')
                );


            if ($type == 'export') {
                return $terms;
            }

            return [
                'error'     =>  false,
                'message'   =>  'Consulta realizada com sucesso!',
                'data'      =>  $terms->get()
            ];
        } catch (PDOException $e) {

            return [
                'error'     =>  true,
                'message'   =>  $e->getMessage(),
                'data'      =>  ''
            ];
        }
    }

    protected static function newFactory()
    {
        return \Modules\Triagem\Database\factories\TermFactory::new();
    }
}
