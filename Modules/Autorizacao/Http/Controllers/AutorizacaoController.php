<?php

namespace Modules\Autorizacao\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Photo;
use Modules\Autorizacao\Entities\Protocol;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Auth;
use Modules\Autorizacao\Http\Livewire\Layouts\App;

class AutorizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $hoje = date('y-M-d');
        $urgentes = Exam::where('exam_status', 'URGENTE')->orwhere('exam_date', date('Y-m-d'))->count();
        $pendentes = Exam::where('exam_status', 'PENDENTE')->count();
        $autorizados = Exam::where('exam_status', 'AUTORIZADO')->count();
        $negados = Exam::where('exam_status', 'NEGADO')->count();
        $aguardando = Exam::where('exam_status', 'AGUARDANDO')->count();
        $protocols = Protocol::all();
        $count = $protocols->count();
        return view('autorizacao::dashboard', compact('urgentes', 'pendentes', 'autorizados', 'negados', 'aguardando'));

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
        $user = Auth::user()->name;

        $protocol = Protocol::create([
            'paciente_name' => $request->name ?? NULL,
            'id' => $request->protocol_id ?? NULL,
            'paciente_id' => $request->pacienteid ?? NULL,
            'observacao' => $request->observacao ?? NULL,
            'created_by' => $user
        ]);
        if ($protocol) {
            for ($i = 0; $i < count($request->protocol_id); $i++) {
                $exam = Exam::create([
                    'name' => $request->proced[$i] ?? NULL,
                    'exam_date' => $request->exam_date[$i] ?? NULL,
                    'exam_status' => $request->exam_status[$i] ?? NULL,
                    'protocol_id' => $protocol->id ?? NULL,
                    'convenio' => $request->convenio[$i] ?? NULL,
                    'exam_cod' => $request->exam_cod[$i] ?? NULL
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

        $user = Auth::user()->name;
        $protocol = Protocol::create([
            'paciente_name' => $request->name ?? NULL,
            'id' => $request->protocol_id ?? NULL,
            'paciente_id' => $request->pacienteid ?? NULL,
            'observacao' => $request->observacao ?? NULL,
            'created_by' => $user
        ]);
        if ($protocol) {

            for ($i = 0; $i < count($request->proced); $i++) {
                $exam = Exam::create([
                    'name' => $request->proced[$i] ?? NULL,
                    'exam_status' => 'URGENTE',
                    'convenio' => $request->convenio ?? NULL,
                    'protocol_id' => $protocol->id ?? NULL
                ]);
            }
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
                $result = Protocol::join('exams', 'exams.protocol_id', '=', 'protocols.id')
                    ->where('exams.exam_status', 'URGENTE')
                    ->orWhere('exams.exam_date', date('Y-m-d'))
                    ->orderBy('exams.exam_date')
                    ->get(['protocols.id', 'protocols.paciente_name', 'protocols.observacao', 'exams.*', 'protocols.created_by']);
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            case 2:
                $result = Protocol::where('exam_status', 'PENDENTE')
                    ->join('exams', 'exams.protocol_id', '=', 'protocols.id')
                    ->orderBy('exams.exam_date')
                    ->get();
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            case 3:
                $result = Protocol::where('exam_status', 'AUTORIZADO')
                    ->join('exams', 'exams.protocol_id', '=', 'protocols.id')
                    ->get();
                return view('autorizacao::tables/table-autorizacao-status', compact('result'));
            case 4:
                $result = Protocol::where('exam_status', 'NEGADO')
                    ->join('exams', 'exams.protocol_id', '=', 'protocols.id')
                    ->get();
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
    public function show()
    {
        $user = Auth::user()->name;
        $protocols = Protocol::where('created_by', "$user")
                    ->get();

        return view('autorizacao::myprotocols', compact('protocols'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $protocol = Protocol::find($id);
        $exam = Exam::all();
        return view('autorizacao::edit', compact('protocol', 'exam'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $exam_id = $dataForm['exam_id'];

        for ($i = 0; $i < count($exam_id); $i++) {

            DB::table('exams')
                ->where('id', $exam_id[$i])
                ->update([
                    'exam_status' => $request->exam_status[$i],
                    'exam_obs' => $request->exam_obs[$i],
                    'exam_date' => $request->exam_date[$i]
                ]);
        }


        return redirect('autorizacao');
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
                ->join('VW_CL_AGENDA_PORTALAGENDA', function ($join) {
                    $join->on('VW_CL_AGENDA_PORTALAGENDA.HORREQID', '=', 'VW_AGENDA.HORREQID')
                        ->on('VW_CL_AGENDA_PORTALAGENDA.HORA', '=', 'VW_AGENDA.HORA');
                })
                ->join('PROCEDIMENTOS', 'PROCEDIMENTOS.PROCID', '=', 'VW_CL_AGENDA_PORTALAGENDA.PROCID')
                ->where('VW_AGENDA.HORREQID', '=', $protocolo)
                ->whereNotNull('VW_AGENDA.CONVENIOID')
                ->select(DB::raw("VW_CL_AGENDA_PORTALAGENDA.HORREQID, FORMAT(VW_AGENDA.DATA, 'yyyy-MM-dd') AS DATA, VW_AGENDA.PACIENTEID, VW_AGENDA.NOMEPAC, VW_AGENDA.CONVDESC, VW_CL_AGENDA_PORTALAGENDA.NOME_PROCEDIMENTO, PROCEDIMENTOS.CODIGO, PROCEDIMENTOS.CODTUSS, VW_AGENDA.CONVENIOID"))
                ->get();
        }

        return view('autorizacao::showprotocol', ['protocolos' => $protocolos, 'paciente' => $pacientes->NOMEPAC, 'pacienteid' => $pacientes->PACIENTEID, 'hoje' => $hoje, 'datafim' => $datafim]);
    }
}
