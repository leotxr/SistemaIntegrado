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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AutorizacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user->can('editar autorizacao'))
        return view('autorizacao::dashboard');
        else
        return view('autorizacao::create');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if(Auth::user()->can('criar autorizacao'))
        return view('autorizacao::create');
        else return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $request->validate([
            'paciente_name' => 'min:1',
        ]);
        
        $protocol = Protocol::create([
            'paciente_id' => $request->pacienteid ?? NULL,
            'paciente_name' => $request->name ?? NULL,
            'observacao' => $request->observation ?? NULL,
            'recebido' => 0,
            'created_by' => Auth::user()->name,
            'user_id' => Auth::user()->id
        ]);
        
        

        
        if ($protocol) {
            for ($i = 0; $i < count($request->exam); $i++) {

                $exam = new Exam;
                $exam->name = $request->exam[$i] ?? NULL;
                $exam->exam_date = $request->exam_date[$i] ?? NULL;
                if($request->exam_date[$i] <= today()->addDays(1)->format('Y-m-d') || $request->exam_date[$i] == NULL)
                {
                   $exam->exam_status_id = 6;
                }else
                {
                    $exam->exam_status_id = 5;
                }
                $exam->protocol_id = $protocol->id;
                $exam->convenio = $request->exam_conv[$i] ?? NULL;
                $exam->exam_cod = $request->exam_cod[$i] ?? NULL;

                $exam->save();
            }

            if ($request->hasFile('photo')) {
                foreach ($request->file('photo') as $photofile) {
  
                    $path = $photofile->store("storage/fotos_pedidos/$protocol->id", ['disk' => 'my_files']);
                    Photo::create([
                        'url' => $path,
                        'protocol_id' => $protocol->id
                    ]);

                }
            }
        }

        if ($protocol)
            return redirect()->back()->with('success', 'Solicitação salva com sucesso!');
        else
            return redirect()->back()->withErrors(['msg' => 'Ocorreu um erro ao salvar a solicitação.']);
    }



    public function myProtocols()
    {
        if(Auth::user()->can('ver autorizacao'))
        return view('autorizacao::myprotocols');
    }

    public function reports()
    {
        if(Auth::user()->can('editar autorizacao'))
        return view('autorizacao::relatorios.relatorios');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {

        $user = Auth::user()->name;
        $user_id = Auth::user()->id;
        $protocols = Protocol::join('exams', 'exams.protocol_id', '=', 'protocols.id')
            ->where('protocols.created_by', "$user")
            ->orWhere('protocols.user_id', "$user_id")
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
