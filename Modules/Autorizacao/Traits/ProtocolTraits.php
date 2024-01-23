<?php

namespace Modules\Autorizacao\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\ProtocolInUse;
use App\Models\User;

trait ProtocolTraits
{
    public $dateTime;

    public function inProcessing($protocol_id){
        $this->dateTime = strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s')));
        ProtocolInUse::create([
            'protocol_id' => $protocol_id,
            'user_id' => Auth::user()->id,
            'expires_at' => date('Y-m-d H:i:s', $this->dateTime)
        ]);
    }

    public function checkProtocol($protocol_id){
        $protocol = DB::table('protocol_in_uses')->where('protocol_id', $protocol_id)->get();

        if($protocol->count() > 0)
            return true;
        else
            return false;
    }

    public function expiredProtocol($protocol_id){

    }

    public function endByProcotol($protocol_id){
        if($this->checkProtocol($protocol_id))
        {
            DB::table('protocol_in_uses')->where('protocol_id', $protocol_id)->delete();
            return true;
        }
        else
            return false;

    }

    public function getUser($protocol_id){
        $user = ProtocolInUse::where('protocol_id', $protocol_id)->first();
        $user = User::find($user['user_id']);

        if($user)
            return $user;
        else
            return false;

    }

    public function endByUser($user_id){
        DB::table('protocol_in_uses')->where('user_id', $user_id)->delete();
        return true;
    }

    public function getProtocol($search_key)
    {
        return DB::connection('sqlserver')
            ->table('VW_AGENDA')
            ->where('VW_AGENDA.HORREQID', '=', $search_key)
            ->select('VW_AGENDA.NOMEPAC', 'VW_AGENDA.PACIENTEID', 'VW_AGENDA.CONVENIOID')
            ->get();
    }

    public function getExamsByProtocol($search_key)
    {
        return DB::connection('sqlserver')
            ->table('VW_AGENDA')
            ->join('VW_CL_AGENDA_PORTALAGENDA', function ($join) {
                $join->on('VW_CL_AGENDA_PORTALAGENDA.HORREQID', '=', 'VW_AGENDA.HORREQID')
                    ->on('VW_CL_AGENDA_PORTALAGENDA.HORA', '=', 'VW_AGENDA.HORA');
            })
            ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'VW_CL_AGENDA_PORTALAGENDA.PROCID')
            ->where('VW_AGENDA.HORREQID', '=', $search_key)
            ->whereNotNull('VW_AGENDA.CONVENIOID')
            ->select(DB::raw("VW_CL_AGENDA_PORTALAGENDA.HORREQID, FORMAT(VW_AGENDA.DATA, 'yyyy-MM-dd') AS DATA, VW_AGENDA.PACIENTEID, VW_AGENDA.NOMEPAC, VW_AGENDA.CONVDESC, VW_CL_AGENDA_PORTALAGENDA.NOME_PROCEDIMENTO, PROCEDIMENTOS.CODIGO, PROCEDIMENTOS.CODTUSS, VW_AGENDA.CONVENIOID"))
            ->get();
    }

    public function saveExam($exam)
    {
        $saving = new Exam();
        $saving->name = $exam['name'];
        $saving->exam_date = $exam['exam_date'] ?? NULL;
        $saving->protocol_id = $this->protocol->id;
        if ($saving->exam_date <= today()->addDays(1)->format('Y-m-d') || $saving->exam_date == NULL) {
            $saving->exam_status_id = 6;
        } else {
            $saving->exam_status_id = 5;
        }
        $saving->convenio = $exam['convenio'];
        $saving->exam_cod = $exam['exam_cod'] ?? NULL;
        $saving->updated_by = Auth::user()->id;

        return $saving->save();
    }
}
