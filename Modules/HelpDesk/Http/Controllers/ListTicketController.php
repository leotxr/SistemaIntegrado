<?php

namespace Modules\HelpDesk\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\HelpDesk\Entities\Ticket;
use Illuminate\Support\Facades\Auth;

class ListTicketController extends Controller
{
    public function all()
    {
        $user = Auth::user();
        $chamados = Ticket::orderBy('hora_abertura', 'desc')->paginate(10);

        return view('helpdesk::chamados.master.alltickets', compact('chamados', 'user'));
    }
}
