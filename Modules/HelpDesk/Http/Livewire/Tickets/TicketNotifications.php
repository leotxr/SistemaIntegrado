<?php

namespace Modules\HelpDesk\Http\Livewire\Tickets;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use App\Events\TicketCreated;

class TicketNotifications extends Component
{
    public $notification;

    protected $listeners = ['echo:dashboard,TicketCreated' => '$refresh', 'refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->readAll();
    }

    public function readAll()
    {
        $user = User::find(Auth::user()->id);

        $user->unreadNotifications->markAsRead();

        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Notificações lidas.']
        );
        return redirect()->back();
    }

    public function deleteAll()
    {
        $user = User::find(Auth::user()->id);
        $user->notifications()->delete();
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'info', 'message' => 'Notificações excluidas.']
        );
        return redirect()->back();
    }

    public function readNotification($notification)
    {
        $this->notification = Auth::user()->unreadNotifications->where('id', $notification)->markAsRead();
        $this->dispatchBrowserEvent(
            'notify',
            ['type' => 'success', 'message' => 'Notificação marcada como lida.']
        );




        //$this->notification->markAsRead();


    }

    public function render()
    {
        return view('helpdesk::livewire.tickets.ticket-notifications', ['unread' => Auth::user()->notifications]);
    }
}
