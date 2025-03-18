<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HelpDesk\Entities\ExtraService;

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

        $servicos = ExtraService::whereBetween('created_at', [$dataInicio . ' 00:00:00', $dataFim . ' 23:59:59'])->get();

        dd($servicos);

        
    }
}
