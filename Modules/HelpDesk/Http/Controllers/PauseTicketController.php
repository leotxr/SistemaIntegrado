<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\Ticket;
use App\Models\User;

class PauseTicketController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $auth_user = Auth::user();
        $chamado = Ticket::find($id);
        $data_hora_atual = date('Y-m-d H:i:s'); //DATA/HORA FORMATO STRING 


        $chamado->pausado = 1;
        $chamado->inicio_pausa = $data_hora_atual;
        $chamado->fim_atendimento = NULL;
        $chamado->status_id = 6; //RECEBE O STATUS DA URL

        if($chamado->save())
        return redirect()->back()->with('success', "Status do chamado alterado para Pausado.");
        else
        return redirect()->back()->withErrors(['msg' => "Não foi possível alterar o status do Chamado."]);
    }
}
