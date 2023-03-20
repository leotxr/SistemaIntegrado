<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TermFileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('triagem::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $hoje = date('d-m-Y');
        $users = Auth::user();
        $triagem = Term::find($request->btn_term_id);
        $start = date('H:i:s');

        return view('triagem::layouts.files.create', compact('triagem'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $hoje = date('d-m-Y');
        $term_id = $request->term_id;
        $patient_name = $request->patient_name;

        //dd($term_id);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $photofile) {
                
                $path = $photofile->store("storage/termos/$patient_name/RM/$hoje/pedido-$patient_name", ['disk' => 'my_files']);
                $files = TermFile::create([
                    'url' => $path,
                    'term_id' => $term_id
                ]);
                

                //$photos->protocol_id = $protocol->id;
                //$photos->save();
            };
        };

        
        if($files)
        return redirect('triagem::terms.index')->with('success', 'Arquivos anexados com sucesso!');
        else
        return redirect()->back()->withErrors(['msg' => 'Ocorreu um erro ao salvar os arquivos.']);
        
        
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
