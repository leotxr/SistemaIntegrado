<?php

namespace Modules\Autorizacao\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Photo;
use Modules\Autorizacao\Entities\Protocol;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Auth;


class AutorizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $hoje = date('y-M-d');
        $urgentes = Exam::where('status_exam', 'URGENTE')->orwhere('exam_date', date('Y-m-d'))->count();
        $pendentes = Exam::where('status_exam', 'PENDENTE')->count();
        $autorizados = Exam::where('status_exam', 'AUTORIZADO')->count();
        $negados = Exam::where('status_exam', 'AGUARDANDO/NEGADO')->count();
        $protocols = Protocol::all();
        $count = $protocols->count();
        return view('autorizacao::dashboard', compact('urgentes', 'pendentes', 'autorizados', 'negados'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('autorizacao::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $protocol = Protocol::create([
            'paciente_name' => $request->name ?? NULL,
            'id' => $request->protocol_id ?? NULL,
            'paciente_id' => $request->pacienteid ?? NULL,
            'observacao' => $request->observacao ?? NULL,
            'created_by' => Auth::user()->name
        ]);
        if ($protocol) {
            for ($i = 0; $i < count($request->protocol_id); $i++) {
                $exam = Exam::create([
                    'name' => $request->proced[$i] ?? NULL,
                    'exam_date' => $request->exam_date[$i] ?? NULL,
                    'status_exam' => $request->status_exam[$i] ?? 'PENDENTE',
                    'protocol_id' => $protocol->id ?? NULL
                ]);
            }

            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $photofile) {
                    //$photos = Photo::create();
                    $path = $photofile->store("storage/fotos_pedidos/$protocol->id", ['disk' => 'my_files']);
                    $photos = Photo::create([
                        'url' => $path,
                        'protocol_id' => $protocol->id
                    ]);

                    //$photos->protocol_id = $protocol->id;
                    //$photos->save();
                    if ($photos)
                        echo '<script>alert("salvou")</script>';
                    else
                        echo '<script>alert("nao salvou")</script>';
                }
            }
        }


        return redirect()->back();
    }

    public function storewtprotocol(Request $request)
    {

        $protocol = Protocol::create([
            'paciente_name' => $request->name ?? NULL,
            'id' => $request->protocol_id ?? NULL,
            'paciente_id' => $request->pacienteid ?? NULL,
            'observacao' => $request->observacao ?? NULL,
        ]);
        if ($protocol) {

            $exam = Exam::create([
                'name' => $request->proced ?? NULL,
                'exam_date' => date('Y-m-d') ?? NULL,
                'protocol_id' => $protocol->id ?? NULL,
                'convenio' => $request->convenio ?? NULL
            ]);
        }


        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photofile) {
                //$photos = Photo::create();
                $path = $photofile->store("storage/fotos_pedidos/$protocol->id", ['disk' => 'my_files']);
                $photos = Photo::create([
                    'url' => $path,
                    'protocol_id' => $protocol->id
                ]);

                //$photos->protocol_id = $protocol->id;
                //$photos->save();
                if ($photos)
                    echo '<script>alert("salvou")</script>';
                else
                    echo '<script>alert("nao salvou")</script>';
            }
        }



        return redirect()->back();
    }


    public function showListAut(Request $request)
    {
        $dataForm = $request->all();
        $status = $dataForm['status'];
        switch ($status) {
            case 1:
                $result = Exam::where('status_exam', 'URGENTE')
                    ->join('protocols', 'exams.protocol_id', '=', 'protocols.id')
                    ->orwhere('exam_date', date('Y-m-d'))
                    ->get();
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            case 2:
                $result = Exam::where('status_exam', 'PENDENTE')->get();
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            case 3:
                $result = Exam::where('status_exam', 'AUTORIZADO')->get();
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            case 4:
                $result = Exam::where('status_exam', 'AGUARDANDO/NEGADO')->get();
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            default:
                echo 'nenhum status foi selecionado';
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('autorizacao::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('autorizacao::edit');
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


    //Busca o protocolo inserido no banco de dados interno do X-Clinic
    public function getProtocol(Request $request)
    {
        $hoje = date('Y-m-d');
        $datafim = date('Y-m-d', strtotime('+1 days'));
        $protocolo = $request->protocolo;

        $pacientes = DB::connection('sqlserver')
            ->table('VW_AGENDA')
            ->where('VW_AGENDA.HORREQID', '=', $protocolo)
            ->select('VW_AGENDA.NOMEPAC', 'VW_AGENDA.PACIENTEID', 'VW_AGENDA.CONVENIOID')
            ->first();

        if ($pacientes) {
            $protocolos = DB::connection('sqlserver')
                ->table('VW_AGENDA')
                ->join('VW_CL_AGENDA_PORTALAGENDA', function($join)
                {
                    $join->on('VW_CL_AGENDA_PORTALAGENDA.HORREQID', '=', 'VW_AGENDA.HORREQID' )
                    ->on('VW_CL_AGENDA_PORTALAGENDA.LIVROID', '=', 'VW_AGENDA.LIVROID');
                })
                ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'VW_CL_AGENDA_PORTALAGENDA.PROCID')
                ->where('VW_AGENDA.HORREQID', '=', $protocolo)
                ->select(DB::raw("VW_AGENDA.HORREQID, FORMAT(VW_AGENDA.DATA, 'yyyy-MM-dd') AS DATA, VW_AGENDA.PACIENTEID, VW_AGENDA.NOMEPAC, VW_AGENDA.CONVDESC, VW_AGENDA.NOME_EXAME, PROCEDIMENTOS.CODIGO, PROCEDIMENTOS.CODTUSS, VW_AGENDA.CONVENIOID"))
                ->get();
        }

        return view('autorizacao::showprotocol', ['protocolos' => $protocolos, 'paciente' => $pacientes->NOMEPAC, 'pacienteid' => $pacientes->PACIENTEID, 'hoje' => $hoje, 'datafim' => $datafim]);
    }
}
