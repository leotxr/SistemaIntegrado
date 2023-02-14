<?php

namespace Modules\Administrativo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Administrativo\Entities\Reason;
use Modules\Administrativo\Entities\MissedTime;
use App\Models\User;


class MissedTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $missedtimes = MissedTime::all();
        return view('administrativo::missedtimes.missedtimes', compact('missedtimes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::all();
        $reasons = Reason::all();
        return view('administrativo::missedtimes.create', compact('users', 'reasons'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $cad = MissedTime::create([
            'user_id' => $request->user_id ?? NULL,
            'data' => $request->data ?? NULL,
            'tempo' => $request->tempo ?? NULL,
            'observacao' => $request->observacao ?? NULL,
            'reason_id' => $request->motivo ?? NULL,
            'justificativa' => $request->justificativa ?? NULL

        ]);

        if ($cad)
            return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('administrativo::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $users = User::find($id);
        $reasons = Reason::find($id);
        $missedtime = MissedTime::find($id);
        return view('administrativo::missedtimes.edit', compact('users', 'reasons', 'missedtime'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $missedTime = MissedTime::find($id);

        $missedTime->data = $request->data;

        $missedTime->tempo = $request->tempo;
        $missedTime->observacao = $request->observacao;
        $missedTime->reason_id = $request->motivo;
        $missedTime->justificativa = $request->justificativa;


        $missedTime->save();
        return redirect()->back();
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
