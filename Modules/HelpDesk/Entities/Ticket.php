<?php

namespace Modules\HelpDesk\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\HelpDesk\Database\factories\TicketFactory;
use Modules\HelpDesk\Entities\TicketMessage;
use Illuminate\Support\Facades\DB;
use PDOException;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requester_id',
        'user_id',
        'ticket_open',
        'ticket_start',
        'ticket_close',
        'ticket_start_pause',
        'ticket_end_pause',
        'status_id',
        'category_id',
        'sub_category_id',
        'priority_id',
        'total_pause',
        'total_ticket'
    ];

    public function TicketRequester()
    {
        return $this->belongsTo('App\Models\User', 'requester_id', 'id');
    }

    public function TicketUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function TicketMessages()
    {
        return $this->hasMany(TicketMessage::class);
    }


    public function TicketFiles()
    {
        return $this->hasMany(TicketFile::class);
    }

    public function TicketCategory()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketCategory', 'category_id', 'id');
    }

    public function TicketSubCategory()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketSubCategory', 'sub_category_id', 'id');
    }

    public function TicketStatus()
    {
        return $this->belongsTo('Modules\HelpDesk\Entities\TicketStatus', 'status_id', 'id');
    }

    public static function getTicketsByDate($data, $type = 'query')
    {
        try {

            $start = $data['start_date'];
            $end = $data['end_date'];

            $tickets = DB::table('tickets as t')
                ->join('users as sol', 'sol.id', '=', 't.requester_id')
                ->join('users as ti', 'ti.id', '=', 't.user_id')
                ->join('user_groups as ug', 'ug.id', '=', 'sol.user_group_id')
                ->join('ticket_categories as tc', 'tc.id', '=', 't.category_id')
                ->join('ticket_sub_categories as tsc', 'tsc.id', '=', 't.sub_category_id')
                ->join('ticket_priorities as tp', 'tp.id', '=', 'tc.priority_id')
                ->whereBetween('t.ticket_open', [$start, $end])
                ->orderBy('t.ticket_open')
                ->select([
                    't.id as TICKET_ID',
                    'sol.name as SOLICITANTE',
                    'ti.name as TI',
                    't.ticket_open as DATA_TICKET',
                    't.title as DESCRICAO',
                    'ug.name as SETOR',
                    'tc.name as CATEGORIA',
                    'tsc.name as SUB_CATEGORIA',
                    'tp.name as PRIORIDADE',
                    \DB::raw('SEC_TO_TIME(t.total_ticket) as TEMPO_TOTAL'),
                    \DB::raw('SEC_TO_TIME(t.wait_time) as ESPERA')
                ]);

            if ($type == 'export') {
                return $tickets;
            }

            return [
                'error'     =>  false,
                'message'   =>  'Consulta realizada com sucesso!',
                'data'      =>  $tickets->get()
            ];
        } catch (PDOException $e) {
            return [
                'error'     => true,
                'message'   => $e->getMessage()
            ];
        }
    }



    protected static function newFactory(): TicketFactory
    {
        return TicketFactory::new();
    }
}
