<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\Ticket;
use App\Models\User;

class ReopenTicketController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $auth_user = Auth::user();
        $chamado = Ticket::find($id);
        $data_hora_atual = date('Y-m-d H:i:s'); //DATA/HORA FORMATO STRING 

        if ($chamado->status_id == 6) //se status antigo for pausado
        {
            $chamado->fim_pausa = $data_hora_atual;
            $tempo_pausa = gmdate('H:i:s', strtotime($data_hora_atual) - strtotime($chamado->inicio_pausa));
            $chamado->tempo_pausa = $tempo_pausa;
        }

        $chamado->pausado = 0;
        $chamado->fim_atendimento = NULL;
        $chamado->status_id = 4; //RECEBE O STATUS EM ATENDIMENTO

        if ($chamado->save())
            return redirect()->back()->with('success', "Status do chamado alterado para Em atendimento.");
        else
            return redirect()->back()->withErrors(['msg' => "Não foi possível realizar a alteração."]);
    }
}
