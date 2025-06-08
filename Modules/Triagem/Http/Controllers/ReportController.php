<?php

namespace Modules\Triagem\Http\Controllers;

use App\Exports\ExamByDateExport as ExportsExamByDateExport;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Triagem\Exports\ExamByDateExport;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $terms = Term::all();
        return view('triagem::painel.relatorios', compact('terms'));
    }

    public function getExamsByDate(Request $request)
    {
        $sectors = $request->sectors;
        $nurses = $request->nurses;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = [
            'sectors'   =>  $sectors,
            'nurses'    =>  $nurses,
            'startDate' =>  $startDate,
            'endDate'   =>  $endDate
        ];

        $return = Term::getTermsByDate($data);

        return response()->json($return);
    }

    public function exportExamsByDate(Request $request)
    {
        $sectors = $request->sectors;
        $nurses = $request->nurses;
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = [
            'sectors'   =>  $sectors,
            'nurses'    =>  $nurses,
            'start_date' =>  $startDate,
            'end_date'   =>  $endDate
        ];

        return Excel::download(new ExamByDateExport($data), 'triagens'.now().'.xlsx');
    }
}
