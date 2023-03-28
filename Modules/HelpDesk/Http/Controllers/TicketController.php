<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Auth\Access\Gate;
use Modules\HelpDesk\Entities\Category;
use Modules\HelpDesk\Entities\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('helpdesk::chamados.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categorias = Category::all();
        $user = Auth::user();
        $chamados = Ticket::all();
        //$permission = $user->permissions->pluck('id');
        if (Auth::user()->permissions->contains('id', 1)) {
            return view('helpdesk::chamados.master.create', compact('categorias', 'user', 'chamados'));
        } else {
            return view('helpdesk::chamados.guest.create', compact('categorias', 'user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $solicitante = Auth::user()->id;
        $hora_abertura = date('Y-m-d H:i:s');

        $cadastro = Ticket::create([
            'assunto' => $request->assunto ?? NULL,
            'descricao_abertura' => $request->descricao ?? NULL,
            'category_id' => $request->categoria ?? NULL,
            'solicitante_id' => $solicitante ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'hora_abertura' => $hora_abertura,
            'status_id' => 2
        ]);


        if ($cadastro)
            return redirect()->back()->With(['success', 'Chamado Aberto com Sucesso!']);
        else
            return redirect()->back()->withErrors('Ocorreu um erro ao salvar.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $user = Auth::user();
        $chamado = Ticket::find($id);
        return view('helpdesk::chamados.master.show', compact('chamado', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = Auth::user();
        $chamado = Ticket::find($id);
        $inicio_atendimento = date('Y-m-d H:i:s');

        if ($chamado->status_id == 2) {
            $chamado->status_id = 4;
            $chamado->inicio_atendimento = $inicio_atendimento;
            $chamado->atendente_id = $user->id;
            $chamado->save();
        }


        return view('helpdesk::chamados.master.edit', compact('chamado', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id, $novo_status)
    {

        $user = Auth::user();
        $chamado = Ticket::find($id);
        $data_hora_atual = date('Y-m-d H:i:s'); //DATA/HORA FORMATO STRING 
        $inicio = strtotime($chamado->inicio_atendimento);//PUXA INICIO DO ATENDIMENTO NO DB E CONVERTE PARA TIME
        $abertura = strtotime($chamado->hora_abertura);
        $chamado->status_id = $novo_status; //RECEBE O STATUS DA URL
        $fim = strtotime($data_hora_atual); //CONVERTE DATA/HORA ATUAL PARA TIME

        switch ($novo_status) {
            case 6: //pausa
                $chamado->pausado = 1;
                $chamado->inicio_pausa = $data_hora_atual;
                $chamado->fim_atendimento = NULL;
                break;

            case 5: //finalizado
            case 7: //cancelado
                $chamado->pausado = 0;
                $chamado->fim_atendimento = $data_hora_atual;
                $tempo_atendimento = gmdate('H:i:s', $fim - $inicio);
                $chamado->tempo_atendimento = $tempo_atendimento;
                $tempo_corrido = gmdate('Y-m-d H:i:s', $fim - $abertura);
                $chamado->tempo_corrido = $tempo_corrido;
                $chamado->descricao_fechamento = $request->descricao_fechamento;
                break;

            case 2://aberto
            case 4://em atendimento
                $chamado->pausado = 0;
                $chamado->fim_atendimento = NULL;
                break;
        }

        $chamado->save();


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
    }
}
