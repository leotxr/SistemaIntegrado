<?php

namespace Modules\HelpDesk\Http\Livewire\Guest;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Traits\TicketActions;

class TicketMessageForm extends Component
{
    use WithFileUploads, TicketActions;

    public Ticket $ticket;
    public $message = '';
    public $ticket_files = [];

    protected $rules = [
        'message' => 'required',
    ];


    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function save()
    {
        $this->validate();
        try {
            if (!$this->ticket->id) {
                throw new \Exception('Ocorreu um erro ao salvar a mensagem. Por favor, tente novamente mais tarde.');
            } else {
                $this->saveMessage($this->ticket, $this->message);

                $this->uploadFile($this->ticket->id, $this->ticket_files);

                $this->reset('message');
                $this->emitUp('refreshParent');
                $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Mensagem adicionada com sucesso!']);

            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => $e->getMessage()]);
        }

    }

    public function clearFiles()
    {
        $this->ticket_files = [];
    }

    public function render()
    {
        return view('helpdesk::livewire.guest.ticket-message-form');
    }
}
