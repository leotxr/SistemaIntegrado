<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\Ticket;
use App\Models\User;

class EndTicketController extends Controller
{
        /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $auth_user = Auth::user();
        $chamado = Ticket::find($id);
        $data_hora_atual = date('Y-m-d H:i:s'); //DATA/HORA FORMATO STRING 
        $inicio_atendimento = strtotime($chamado->inicio_atendimento);//PUXA INICIO DO ATENDIMENTO NO DB E CONVERTE PARA TIME
        $abertura = strtotime($chamado->hora_abertura);
        $fim_atendimento = strtotime($data_hora_atual); //CONVERTE DATA/HORA ATUAL PARA TIME

        $tempo_corrido = gmdate('H:i:s', $fim_atendimento - $abertura);
        $tempo_atendimento = gmdate('H:i:s', $fim_atendimento - $inicio_atendimento);
        
        $chamado->tempo_atendimento = $tempo_atendimento;
        $chamado->pausado = 0;
        $chamado->fim_atendimento = $data_hora_atual;
        $chamado->tempo_corrido = $tempo_corrido;
        $chamado->descricao_fechamento = $request->message;
        $chamado->tempo_total = gmdate('H:i:s', strtotime($tempo_atendimento) - strtotime($chamado->tempo_pausa));
        $chamado->status_id = 5; //RECEBE O STATUS FINALIZADO

        if($chamado->save())
        return redirect()->back()->with('success', "Status do chamado alterado para Finalizado.");
        else
        return redirect()->back()->withErrors(['msg' => "Não foi possível realizar a alteração."]);
    }
}
