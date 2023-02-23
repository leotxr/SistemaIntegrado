<?php

namespace Modules\Autorizacao\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Autorizacao\Entities\Protocol;
use Illuminate\Support\Facades\Auth;

class ProtocolController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('autorizacao::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('autorizacao::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('autorizacao::edit');
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
    public function destroy($protocol)
    {
        $delete = Protocol::find($protocol)->delete();

        if($delete)
        return redirect('autorizacao')->with('success', 'Solicitação excluida com sucesso!'); 
        else
        return redirect('autorizacao')->withErrors(['msg' => 'Ocorreu um erro ao excluir a solicitação.']);
    }
}
