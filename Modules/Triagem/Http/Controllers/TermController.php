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
        $hoje = date('Y-m-d');
        $users = User::all();
        $tipoexame = $request->procedimento;
        $paciente_id = $request->paciente_id;
        $start = date('H:i:s');

        $paciente = DB::connection('sqlserver')
            ->table('FATURA')
            ->where('PACIENTE.PACIENTEID', '=', $paciente_id);

        if ($tipoexame == 0) {
            $paciente->where('FATURA.SETORID', 9);
        } else {
            $paciente->where('FATURA.SETORID', 4);
        }

        $paciente = $paciente->where('DATA', $hoje)
            ->join('PACIENTE', 'PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
            ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->select('PACIENTE.PACIENTEID', 'FATURA.DATA', 'PACIENTE.NOME', 'PACIENTE.DATANASC')
            ->first();


        if ($paciente && $tipoexame == 0)
            return view('triagem::terms.create-rm', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
        elseif ($paciente && $tipoexame == 1)
            return view('triagem::terms.create-tc', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
        else
            return redirect()->back()->withErrors(['msg' => 'Informe corretamente o Código do paciente e o procedimento.']);
        return view('triagem::terms.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $hoje = date('d-m-Y');
        $nascimento = $request->nascimento;

        $start = strtotime($request->start);
        $end = date('H:i:s');
        $end_convert = strtotime($end);

        $tempo = gmdate('H:i:s', $end_convert - $start);

        $user_id = Auth::user()->id;



        $term = Term::create([
            'patient_name' => $request->nome ?? NULL,
            'patient_id' => $request->pacienteid ?? NULL,
            'user_id' => $user_id ?? NULL,
            'patient_age' => $request->patient_age ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'final_hour' => $end,
            'time_spent' => $tempo,
            'exam_date' => $request->exam_date,
            'observation' => 1

        ]);

        #ARMAZENA PRINT DO TERMO DE CONSTRASTE
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/termo-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/termo-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 3
            ]);
        }

        #ARMAZENA PRINT DO TERMO TELELAUDO
        if ($request->dataurltele) {
            $img = $request->dataurltele;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/telelaudo-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/telelaudo-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 2
            ]);
        }


        if ($term)
            return redirect('triagem/terms')->with('success', 'Triagem salva com sucesso!');
        else
            return redirect('triagem/terms')->with('error', 'Ocorreu um erro!');


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
        $termo = Term::find($id);
        $medico = User::permission('medico')->get();
        return view('triagem::terms.edit-rm', compact('termo', 'medico'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $term)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($term);
        $update = DB::table('terms')
            ->where('id', $term->id)
            ->update([
                'contrast' => 1,
            ]);

        #ARMAZENA PRINT DO FORMULARIO DE CONSTRASTE
        if ($request->dataurlcontraste) {
            $img = $request->dataurlcontraste;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/contraste-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/contraste-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 4
            ]);
        }

        if ($update)
            return redirect('triagem/terms')->with('success', 'Contraste aplicado com sucesso!');
        else
            return redirect()->back()->withErrors(['Ocorreu um erro ao salvar']);
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

        $terms = Term::whereBetween('exam_date', [$data_inicio, $data_fim])->where('proced', $procedimento)->get();

        if ($terms)
            return view('triagem::relatorios', compact('terms'))->with('success', 'Consulta realizada com sucesso!');
        else
            return view('triagem::relatorios')->with('error', 'Ocorreu um erro!');
    }
}
