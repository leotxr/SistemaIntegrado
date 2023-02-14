<?php

namespace Modules\Administrativo\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Administrativo\Entities\ExtraTime;
use Modules\Administrativo\Entities\Reason;
use Modules\Administrativo\Entities\MissedTime;
use App\Models\User;

use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Auth;

class ExtraTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $extratimes = ExtraTime::all();
        return view('administrativo::extratimes.extratimes', compact('extratimes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::all();
        $reasons = Reason::all();
        return view('administrativo::extratimes.create', compact('users', 'reasons'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $cad = ExtraTime::create([
            'user_id' => $request->user_id ?? NULL,
            'data' => $request->data ?? NULL,
            'tempo' => $request->tempo ?? NULL,
            'observacao' => $request->observacao ?? NULL,
            'reason_id' => $request->motivo ?? NULL,
            'justificativa' => $request->justificativa ?? NULL

        ]);

        return redirect('administrativo');
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
        $extratime = ExtraTime::find($id);
        return view('administrativo::extratimes.edit', compact('users', 'reasons', 'extratime'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $update = ExtraTIme::where(['id'=>$id])->update([
            'user_id' => $request->user_id ?? NULL,
            'data' => $request->data ?? NULL,
            'tempo' => $request->tempo ?? NULL,
            'observacao' => $request->observacao ?? NULL,
            'reason_id' => $request->motivo ?? NULL,
            'justificativa' => $request->justificativa ?? NULL
        ]);

        if($update)
        return redirect('extratimes');
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
