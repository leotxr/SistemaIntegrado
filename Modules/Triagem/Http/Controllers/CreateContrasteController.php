<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use App\Models\User;

class CreateContrasteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __invoke($id)
    {
        $termo = Term::find($id);
        $medico = User::permission('medico')->get();
        return view('triagem::terms.edit-rm', compact('termo', 'medico'));
    }
}
