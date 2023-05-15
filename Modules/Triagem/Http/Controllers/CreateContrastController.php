<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use App\Models\User;

class CreateContrastController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createContrast($id, $sector)
    {
        $termo = Term::find($id);
        $medico = User::permission('medico')->get();

        if($sector == 1)
        return view('triagem::ressonancia.contraste', compact('termo', 'medico'));
        elseif($sector == 2)
        return view('triagem::tomografia.contraste', compact('termo', 'medico'));
    }


}
