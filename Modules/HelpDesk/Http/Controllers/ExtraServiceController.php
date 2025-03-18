<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HelpDesk\Entities\ExtraService;
use Illuminate\Support\Facades\DB;

class ExtraServiceController extends Controller
{
    private $extraService;

    public function __construct()
    {
        $this->extraService = new ExtraService();
    }

    public function index()
    {
        return view('helpdesk::reports.extra-services-report');
    }

    public function show(Request $request)
    {
        $dataInicio = $request->start_date;
        $dataFim = $request->end_date;

        dd($dataFim);

        $servicos = DB::table('extra_services')
        ->whereBetween('created_at', ['2025-01-01 00:00:00', '2025-01-31 23:59:59'])
        ->get();

        dd($servicos);

        
    }
}
