<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Triagem\Entities\Term;
use App\Charts\Triagem\TriagensChart;

class TriagemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('triagem::index');
    }

    public function showSignature($id)
    {
        $user = User::select('signature')->where('id', $id)->get()->toArray();
        dd($user);
        return response($user);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function dashboard()
    {
        $triagens_hoje = Term::whereDate('created_at', today()->subDays(17))->count();
        $triagens_ontem = Term::whereDate('created_at', today()->subDays(1))->count();
        $triagens_2_dias = Term::whereDate('created_at', today()->subDays(2))->count();
        $chart = new TriagensChart;
        $chart->labels(['2 Dias Atrás', 'Ontem', 'Hoje']);
        $chart->dataset('Triagens', 'line', [$triagens_2_dias, $triagens_ontem, $triagens_hoje]);
        return view('triagem::painel.dashboard', compact('chart', 'triagens_hoje'));
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
        return view('triagem::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('triagem::edit');
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
