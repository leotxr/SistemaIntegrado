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
use Barryvdh\DomPDF\Facade\Pdf;

class TermController extends Controller
{

    public function index()
    {
        $hoje = date('Y-m-d');
        $terms = Term::whereDate('exam_date', $hoje)->paginate(15);
        return view('triagem::triagens.index', compact('terms'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createRessonancia(Request $request)
    {
        $hoje = date('Y-m-d');
        $users = User::all();
        $tipoexame = $request->procedimento;
        $paciente_id = $request->paciente_id;
        $start = date('H:i:s');

        $paciente = DB::connection('sqlserver')
            ->table('FATURA')
            ->where('PACIENTE.PACIENTEID', '=', $paciente_id)
            ->where('FATURA.SETORID', 9)
            ->where('DATA', $hoje)
            ->join('PACIENTE', 'PACIENTE.PACIENTEID', '=', 'FATURA.PACIENTEID')
            ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'FATURA.PROCID')
            ->select('PACIENTE.PACIENTEID', 'FATURA.DATA', 'PACIENTE.NOME', 'PACIENTE.DATANASC', 'PROCEDIMENTOS.DESCRICAO')
            ->first();


        if ($paciente)
            return view('triagem::ressonancia.create', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
        else
            return redirect()->back()->withErrors(['msg' => 'Informe corretamente o Código do paciente e o procedimento.']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createTomografia()
    {
        return view('triagem::create');
    }

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



        $term = Term::updateOrCreate([
            'patient_name' => $request->nome ?? NULL,
            'patient_id' => $request->pacienteid ?? NULL,
            'user_id' => $user_id ?? NULL,
            'patient_age' => $request->nascimento ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'final_hour' => $end,
            'time_spent' => $tempo,
            'exam_date' => date('Y-m-d'),
            'observation' => $request->observacoes ?? NULL

        ]);

        
        #ARMAZENA PRINT DO QUESTIONARIO
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/questionario-$term->patient_name.png", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/questionario-$term->patient_name.png";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 6
            ]);
        }
/*
        //ASSINATURA
        if ($request->dataurlsign) {
            $img = $request->dataurlsign;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/assinatura-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/assinatura-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 5
            ]);
        }
*/

        //$pdf = PDF::loadView('triagem::pdfteste', ['term' => $term]);
        //$path = $photofile->store("storage/fotos_pedidos/$protocol->id", ['disk' => 'my_files']);
        //$path = Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/termo-$term->patient_name.pdf", $pdf->output());
        //return $pdf->download('teste.pdf');


        if ($term)
            return view('triagem::index', compact('term'))->with('success', 'Triagem salva com sucesso!');
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
        //
    }

    public function createSignature($id)
    {
        $term = Term::find($id);
        return view('triagem::triagens.assinar', compact('term'));
    }

    public function storeSignature($id, Request $request)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($id);

        if ($request->sign) {
            $img = $request->sign;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $bin = base64_decode($image_parts[1]);

            //salva a imagem da assinatura
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/assinatura-$term->patient_name.png", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/assinatura-$term->patient_name.png";

            //cria imagem da assinatura
            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 5
            ]);

            $term->signed = 1;
            $term->save();

            return redirect('triagem/realizadas')->with('success', 'Triagem assinada com sucesso!');
        }else
        return redirect()->back()->withErrors(['Não foi possível salvar esta assinatura.']);
    }

}
