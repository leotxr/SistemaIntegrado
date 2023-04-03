<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\Triagem\Entities\FileType;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $hoje = date('Y-m-d');
        $terms = Term::whereDate('exam_date', $hoje)->get();
        return view('triagem::terms.index', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
       

        //dd($img);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($term)
    {
        $term = Term::find($term);
        $file_type = FileType::all();
        return view('triagem::terms.show-rm', compact('term', 'file_type'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $term)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($term)
    {
        $delete = Term::find($term)->delete();


        if ($delete)
            return redirect()->back()->with('success', 'Triagem excluida com sucesso!');
        else
            return redirect()->back()->withErrors(['msg' => 'Ocorreu um erro ao excluir a triagem.']);
    }

    public function showSignature(Request $request)
    {
        $dataForm = $request->all();
        $user_id = $dataForm['medico'];

        $user = User::where('id', $user_id)
            ->get();

        return view('triagem::layouts.partials.contraste.rodape-contraste-rm', ['user' => $user]);
    }

    public function relatorioTriagem(Request $request)
    {
        $data_inicio = $request->data_inicio;
        $data_fim = $request->data_fim;
        $procedimento = $request->procedimento;

        $terms = Term::whereBetween('exam_date', [$data_inicio, $data_fim])->get();

        if ($terms)
            return view('triagem::relatorios', compact('terms'))->with('success', 'Consulta realizada com sucesso!');
        else
            return view('triagem::relatorios')->with('error', 'Ocorreu um erro!');
    }
}
