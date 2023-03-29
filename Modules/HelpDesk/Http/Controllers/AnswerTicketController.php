<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\Ticket;
use App\Models\User;

class AnswerTicketController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $auth_user = Auth::user();
        $chamado = Ticket::find($id);
        $data_hora_atual = date('Y-m-d H:i:s'); //DATA/HORA FORMATO STRING 

        $chamado->inicio_atendimento = $data_hora_atual;
        $chamado->atendente_id = $request->atendente_id ?? $auth_user->id;

        $chamado->pausado = 0;
        $chamado->fim_atendimento = NULL;
        $chamado->status_id = 4; //RECEBE O STATUS EM ATENDIMENTO

        if ($chamado->save())
            return redirect()->back()->with('success', "Status do chamado alterado para Em atendimento.");
        else
            return redirect()->back()->withErrors(['msg' => "Não foi possível realizar a alteração."]);
    }
}
