<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\Category;
use Modules\HelpDesk\Entities\Ticket;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $chamados_abertos = Ticket::where('status_id', 2)->get();
        $count_abertos = Ticket::where('status_id', 2)->count();

        $chamados_atendimento = Ticket::where('status_id', 4)->get();
        $count_atendimento = Ticket::where('status_id', 4)->count();
        return view('helpdesk::painel.index', compact('user', 'chamados_abertos', 'count_abertos', 'chamados_atendimento', 'count_atendimento'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categorias = Category::all();
        $user = Auth::user();
        return view('helpdesk::painel.configuracoes.cadastros', compact('user', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('helpdesk::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('helpdesk::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
