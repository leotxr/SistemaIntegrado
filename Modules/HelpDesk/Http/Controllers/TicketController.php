<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketFile;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TicketsExport;

class TicketController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function __construct()
    {
        
    }
    public function index()
    {

        return view('helpdesk::dashboard.dashboard');
    }

    public function guest()
    {
        return view('helpdesk::guest.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('helpdesk::tickets.create');
    }

    public function all()
    {
        return view('helpdesk::tickets.all_tickets');
    }

    public function notifications()
    {
        return view('helpdesk::tickets.unread_notifications');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {


        $ticket = Ticket::create([
            'title' => $request->ticket_title,
            'description' => $request->ticket_description ?? NULL,
            'requester_id' => Auth::user()->id,
            'ticket_open' => date('Y-m-d H:i:s'),
            'status_id' => 1,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->subcategory_id
        ]);


        if ($request->hasFile('ticket_files')) {
            foreach ($request->file('ticket_files') as $photofile) {

                $path = $photofile->store("storage/helpdesk/$ticket->id", ['disk' => 'my_files']);
                TicketFile::create([
                    'url' => $path,
                    'ticket_id' => $ticket->id,
                    'user_id' => Auth::user()->id
                ]);
            }
        }

        if ($ticket)
            return redirect('/helpdesk/chamados')->with('success', 'Solicitação salva com sucesso!');
        else
            return redirect('/helpdesk/chamados')->withErrors(['msg' => 'Ocorreu um erro ao salvar a solicitação.']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('helpdesk::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('helpdesk::tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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

    public function getTicketsByDate(Request $request)
    {
        $data = ['start_date' => $request->initial_date, 'end_date' => $request->final_date];

        $tickets = Ticket::getTicketsByDate($data, $request->type);

        return response()->json($tickets);
    }

    public function exportTicketsByDate(Request $request)
    {
        $data = ['start_date' => $request->initial_date, 'end_date' => $request->final_date];
        return Excel::download(new TicketsExport($data), 'tickets'.now().'.xlsx');
    }
}
