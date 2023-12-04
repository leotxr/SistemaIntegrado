<?php

namespace Modules\Autorizacao\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
}
