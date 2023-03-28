<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'solicitante_id',
        'atendente_id',
        'sector_id',
        'category_id',
        'sub_category_id',
        'status_id',
        'assunto',
        'descricao_abertura',
        'descricao_fechamento',
        'hora_abertura',
        'tempo_corrido',
        'inicio_atendimento',
        'fim_atendimento',
        'tempo_atendimento',
        'pausado',
        'inicio_pausa',
        'fim_pausa',
        'tempo_pausa',
        'tempo_total'
    ];

    public function relSector()
    {
        return $this->hasOne(Sector::class);
    }

    public function relCategory()
    {
        return $this->hasOne('Modules\HelpDesk\Entities\Category', 'id', 'category_id');
    }

    public function relStatus()
    {
        return $this->hasOne('Modules\HelpDesk\Entities\Status', 'id', 'status_id');
    }

    public function relAtendente()
    {
        return $this->hasOne('App\Models\User', 'id', 'atendente_id');
    }

    public function relSolicitante()
    {
        return $this->hasOne('App\Models\User', 'id', 'solicitante_id');
    }

    public function relTicketMessage()
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function relTicketFile()
    {
        return $this->hasMany(TicketFile::class);
    }


    
    protected static function newFactory()
    {
        return \Modules\HelpDesk\Database\factories\TicketFactory::new();
    }
}
