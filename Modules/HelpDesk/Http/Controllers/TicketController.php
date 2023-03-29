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
        $user_ti = User::permission('admin')->get();
        $chamado = Ticket::find($id);
        $inicio_atendimento = date('Y-m-d H:i:s');

        return view('helpdesk::chamados.master.edit', compact('chamado', 'user', 'user_ti'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id, $novo_status)
    {

       
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
