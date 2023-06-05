<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Entities\Sector;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TermController extends Controller
{

    public function indexRessonancia()
    {
        $sector = Sector::find(1);
        return view('triagem::ressonancia.index', ['sector' => $sector]);
    }

    public function indexTomografia()
    {
        $sector = Sector::find(2);
        return view('triagem::tomografia.index', ['sector' => $sector]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createTriagem(Request $request, $setor_id, $paciente_id)
    {
        $hoje = date('Y-m-d');
        $users = User::all();
        $tipoexame = $request->procedimento;
        $start = date('H:i:s');

        $paciente = DB::connection('sqlserver')
            ->table('FATURA')
            ->where('PACIENTE.PACIENTEID', '=', $paciente_id)
            ->where('FATURA.SETORID', $setor_id)
            ->where('DATA', $hoje)
            ->join('PACIENTE', 'PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
            ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->select('PACIENTE.PACIENTEID', 'FATURA.DATA', 'PACIENTE.NOME', 'PACIENTE.DATANASC', 'PROCEDIMENTOS.DESCRICAO')
            ->first();


        if (Auth::user()->can('criar triagem')) {
            if ($setor_id == 9)
                return view('triagem::ressonancia.create', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
            elseif ($setor_id == 4)
                return view('triagem::tomografia.create', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
            else
                return redirect()->back()->withErrors(['msg' => 'Informe corretamente o Código do paciente e o procedimento.']);
        } else {
            return redirect()->back()->withErrors(['msg' => 'Você não possui permissão para iniciar uma triagem.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function storeRessonancia(Request $request)
    {
        $hoje = date('d-m-Y');
        $nascimento = $request->nascimento;

        $start = strtotime($request->start);
        $end = date('H:i:s');
        $end_convert = strtotime($end);

        $tempo = gmdate('H:i:s', $end_convert - $start);

        $user_id = Auth::user()->id;

        $setor = Sector::find(1);

        $term = Term::create([
            'patient_name' => $request->nome ?? NULL,
            'patient_id' => $request->pacienteid ?? NULL,
            'user_id' => $user_id ?? NULL,
            'patient_age' => $request->nascimento ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'exam_date' => date('Y-m-d'),
            'sector_id' => $setor->id,
            'finished' => 0,
            'observation' => $request->observacoes ?? NULL

        ]);



        for ($i = 1; $i < count($request->pergunta); $i++) {

            //$teste[$i] = ['id' => $i, 'pergunta' => $request->pergunta[$i], 'resposta' => $request->resposta[$i]];
            $collection[$i] = collect(['pergunta' => $request->pergunta[$i], 'resposta' => $request->radio[$i], 'observacao' => $request->observacao[$i]]);
        };

        $pdf = PDF::loadView('triagem::PDF.pdf-questionario', ['collection' => $collection, 'title' => "Questionário para realização de Ressonância Magnética", 'term' => $term]);
        $save = Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.pdf", $pdf->output());
        $path = "storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.pdf";

        if ($path) {
            TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 6
            ]);
        } else return redirect()->back()->with('error', 'Ocorreu um erro!');

        if ($term && $path)
            return view('triagem::triagens.assinar', compact('term'))->with('success', 'Triagem salva com sucesso!');
        else
            return redirect()->back()->with('error', 'Ocorreu um erro!');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */

    public function storeTomografia(Request $request)
    {
        $hoje = date('d-m-Y');
        $nascimento = $request->nascimento;

        $start = strtotime($request->start);
        $end = date('H:i:s');
        $end_convert = strtotime($end);

        $tempo = gmdate('H:i:s', $end_convert - $start);

        $user_id = Auth::user()->id;

        $setor = Sector::find(2);


        $term = Term::updateOrCreate([
            'patient_name' => $request->nome ?? NULL,
            'patient_id' => $request->pacienteid ?? NULL,
            'user_id' => $user_id ?? NULL,
            'patient_age' => $request->nascimento ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'exam_date' => date('Y-m-d'),
            'sector_id' => $setor->id,
            'finished' => 0,
            'observation' => $request->observacoes ?? NULL

        ]);

        for ($i = 1; $i < count($request->pergunta); $i++) {

            //$teste[$i] = ['id' => $i, 'pergunta' => $request->pergunta[$i], 'resposta' => $request->resposta[$i]];
            $collection[$i] = collect(['pergunta' => $request->pergunta[$i], 'resposta' => $request->radio[$i], 'observacao' => $request->observacao[$i]]);
        };

        $pdf = PDF::loadView('triagem::PDF.pdf-questionario', ['collection' => $collection, 'title' => "Questionário para realização de Tomografia Computadorizada", 'term' => $term]);
        $save = Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.pdf", $pdf->output());
        $path = "storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.pdf";

        if ($path) {
            TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 6
            ]);
        } else return redirect()->back()->with('error', 'Ocorreu um erro!');

        if ($term && $path)
            return view('triagem::triagens.assinar', compact('term'))->with('success', 'Triagem salva com sucesso!');
        else
            return redirect()->back()->with('error', 'Ocorreu um erro!');
    }

    public $path = "";

    public function createSignature($id)
    {
        $term = Term::find($id);
        $this->path = TermFile::where('term_id', $term->id)->where('file_type_id', 5)->first();

        return view('triagem::triagens.assinar', ['term' => $term, 'path' => $this->path]);
    }
}
