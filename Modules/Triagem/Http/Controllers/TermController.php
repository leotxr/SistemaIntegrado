<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Modules\Triagem\Entities\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('triagem::terms.terms');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $hoje = date('Y-m-d');
        $users = User::all();
        $tipoexame = $request->procedure;
        $paciente_id = $request->patient_id;
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
            return view('triagem::livewire.termscreen.rm', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
        elseif($paciente && $tipoexame == 1)
            return view('triagem::livewire.termscreen.tc', compact('users', 'tipoexame', 'start', 'paciente', 'hoje'));
            else
            return redirect()->back()->withErrors(['msg' => 'Informe corretamente o Código do paciente e o procedimento.']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $hoje = date('d/m/Y');
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
            'patient_age' => $idade ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'final_hour' => $end,
            'time' => $tempo,
            'exam_date' => $request->exam_date,
            'observation' => 1

        ]);

        #ARMAZENA PRINT DO TERMO DE CONSTRASTE
        $img = $request->dataurl;
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        Storage::disk('my_files')->put("storage/termos/$term->id/contraste-$term->patient_name.jpeg", $image_base64);

        #ARMAZENA PRINT DO TERMO TELELAUDO
        $img = $request->dataurltele;
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        Storage::disk('my_files')->put("storage/termos/$term->id/telelaudo-$term->patient_name.jpeg", $image_base64);

        if ($term) 
            return redirect('terms')->with('success', 'Triagem salva com sucesso!'); 
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
