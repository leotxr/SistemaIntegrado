<?php

namespace Modules\Administrativo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Administrativo\Traits\ReceptionTrait;

class AdministrativoController extends Controller
{
    use ReceptionTrait;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('administrativo::dashboard');
    }

    public function getData($data1, $data2)
    {
        $query = $this->getWaitQueue($data1, $data2)->join('USUARIOS', 'USUARIOS.USERID', '=', 'TOTEM_FILAS_ESPERA.CHAMADO')->selectRaw('USUARIOS.NOME AS USUARIO, USUARIOS.USERID AS USERID')->get();

        return view('administrativo::monitoramento.reception.report', compact('query'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('administrativo::create');
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
        return view('administrativo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('administrativo::edit');
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
