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
        $hoje = date('Y-m-d');
        $terms = Term::whereDate('exam_date', $hoje)->where('sector_id', 1)->get();
        return view('triagem::ressonancia.index', ['terms' => $terms]);
    }

    public function indexTomografia()
    {
        $hoje = date('Y-m-d');
        $terms = Term::whereDate('exam_date', $hoje)->where('sector_id', 2)->get();
        return view('triagem::tomografia.index', ['terms' => $terms]);
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


        if ($setor_id == 9)
            return view('triagem::ressonancia.create', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
        elseif($setor_id == 4)
            return view('triagem::tomografia.create', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
        else
            return redirect()->back()->withErrors(['msg' => 'Informe corretamente o Código do paciente e o procedimento.']);
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

        $term = Term::updateOrCreate([
            'patient_name' => $request->nome ?? NULL,
            'patient_id' => $request->pacienteid ?? NULL,
            'user_id' => $user_id ?? NULL,
            'patient_age' => $request->nascimento ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'exam_date' => date('Y-m-d'),
            'sector_id' => $setor->id,
            'observation' => $request->observacoes ?? NULL

        ]);


        #ARMAZENA PRINT DO QUESTIONARIO
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.bmp", $bin);
            $path = "storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.bmp";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 6
            ]);
        }

        if ($term)
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
            'observation' => $request->observacoes ?? NULL

        ]);


        #ARMAZENA PRINT DO QUESTIONARIO
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.bmp", $bin);
            $path = "storage/termos/$term->patient_name/$setor->name/$hoje/questionario-$term->patient_name.bmp";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 6
            ]);
        }

        if ($term)
            return view('triagem::triagens.assinar', compact('term'))->with('success', 'Triagem salva com sucesso!');
        else
            return redirect()->back()->with('error', 'Ocorreu um erro!');
    }

    public function testeStore(Request $request)
    {
        
        for ($i = 0; $i < count($request->pergunta); $i++) {

            $dump = $i;

        }
        

        dd($dump);

        //$pdf = PDF::loadView('triagem::PDF.pdf-telelaudo', ['term' => $this->term, 'signature' => $signature]);
    }

    public $path = "";

    public function createSignature($id)
    {
        $term = Term::find($id);
        $this->path = TermFile::where('term_id', $term->id)->where('file_type_id', 5)->first();
        
        return view('triagem::triagens.assinar', ['term' => $term, 'path' => $this->path]);
    }
   
}
