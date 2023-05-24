<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Entities\Sector;
use Illuminate\Support\Facades\Auth;
use Modules\Triagem\Entities\FileType;

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
    public function create($id)
    {
        $hoje = date('d-m-Y');
        $users = Auth::user();
        $triagem = Term::find($id);
        $file_types = FileType::all();
        $start = date('H:i:s');

        return view('triagem::triagens.files.create', compact('triagem', 'file_types'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request, $id)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($id);
        $signature = TermFile::where('term_id', $term->id)->where('file_type_id', 5)->first();

        $setor = Sector::find($term->sector_id);

        //dd($term->patient_name);


        if ($request->hasFile('arquivos')) {

            $path = $request->file('arquivos')->store("storage/termos/$term->patient_name/RM/$hoje/arquivo-$term->patient_name", ['disk' => 'my_files']);
            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => $request->tipo,
                //'description' => $request->observacoes
            ]);
        }

        /*
        $pdf = PDF::loadView('triagem::pdfteste', ['term' => $term, 'signature' => $signature]);
        // $path = Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/termo-$term->patient_name.pdf", $pdf->output());
        return $pdf->download('teste.pdf');
*/



        if ($request->hasFile('arquivos'))
            return redirect('triagem/realizadas')->with('success', 'Arquivos anexados com sucesso!');
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
