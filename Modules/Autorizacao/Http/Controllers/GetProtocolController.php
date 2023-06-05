<?php

namespace Modules\Autorizacao\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GetProtocolController extends Controller
{

    public function __invoke(Request $request)
    {


        return view('settings.create', compact('permissions', 'roles'));
    }

}
