<?php

namespace Modules\Administrativo\Http\Livewire\ExtraService\Dashboard;

use App\Events\TicketCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Modules\HelpDesk\Entities\ExtraService;
use Modules\HelpDesk\Entities\ExtraServiceMessage;
use Modules\HelpDesk\Entities\Ticket;
use Modules\HelpDesk\Entities\TicketMessage;
use Modules\HelpDesk\Notifications\NotifyTicketCreated;
use Modules\HelpDesk\Traits\TicketActions;

class EditExtraService extends Component
{
    use TicketActions;

    public $modalEdit = false;
    public $modalFinish = false;
    public $modalPause = false;
    public ExtraService $extra_service;
    public $colors = ['black', '#f97316', '#22c55e', '#eab308', '#3b82f6'];
    public $ticket;
    public $message = '';
    public $confirmTicket = false;

    protected $listeners = ['editService' => 'openModalEdit',
        'refresh' => '$refresh'
    ];

    protected $rules = ['message' => 'required'];

    public function openModalEdit(ExtraService $extra_service)
    {
        $this->extra_service = $extra_service;
        $this->modalEdit = true;
    }

    public function checkStatusAndApply(int $new_status)
    {
        $this->extra_service->status_id == $new_status ? throw new \Exception('Ocorreu um erro ao aplicar o status à solicitação.') : $this->extra_service->status_id = $new_status;

    }

    public function saveExtraServiceMessage(ExtraService $extra_service, $message, $is_action)
    {
        $extra_service_message = new ExtraServiceMessage();
        $extra_service_message->message = $message;
        $extra_service_message->user_id = Auth::user()->id;
        $extra_service_message->extra_service_id = $extra_service->id;
        $extra_service_message->read = 0;
        $is_action ? $extra_service_message->is_final_action = true : $extra_service_message->is_final_action = false;
        if ($extra_service_message->save()) {
            return true;
        } else throw new \Exception('Ocorreu um erro ao salvar a mensagem.');

    }

    public function createTicket()
    {
        $this->ticket = new Ticket();
        $this->ticket->title = $this->extra_service->title;
        $this->ticket->description = $this->extra_service->description;
        $this->ticket->requester_id = $this->extra_service->requester_id;
        $this->ticket->ticket_open = now();
        $this->ticket->status_id = 1;
        $this->ticket->category_id = 8;
        $this->ticket->sub_category_id = 44;

        if ($this->ticket->save()) {
            $users = User::where('user_group_id', 9)->get();
            TicketCreated::dispatch(Auth::user(), $this->ticket);
            Notification::send($users, new NotifyTicketCreated(Auth::user(), $this->ticket));
            return $this->ticket;
        } else throw new \Exception('Ocorreu um erro ao tentar salvar o ticket.');
    }

    public function start()
    {
        try {
            $this->checkStatusAndApply(4);
            $this->user_id = Auth::user()->id;
            $this->extra_service->save();
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Atendimento iniciado com sucesso!']);
            $this->modalEdit = false;
            $this->emitUp('refreshParent');
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => $exception->getMessage()]);
        }
    }

    public function openPause()
    {
        try {

            $this->reset('message');
            $this->modalPause = true;
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => $exception->getMessage()]);
        }

    }

    /**
     * @throws \Exception
     */
    public function pause()
    {
        try {
            $this->checkStatusAndApply(3);
            $this->extra_service->save();
            $this->saveExtraServiceMessage($this->extra_service, $this->message, false);
            $this->dispatchBrowserEvent('notify', ['type' => 'info', 'message' => 'Atendimento pausado!']);
            $this->emit('refresh');
            $this->modalPause = false;
            $this->emitUp('refreshParent');
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => $exception->getMessage()]);
        }

    }

    public function openFinish()
    {
        $this->reset('message');
        $this->modalFinish = true;
    }

    public function finish()
    {
        try {
            $this->validate();
            $this->checkStatusAndApply(2);
            $this->extra_service->action = $this->message;
            $this->saveExtraServiceMessage($this->extra_service, $this->message, true);
            $this->extra_service->save();
            $this->emit('refresh');
            $this->modalFinish = false;
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Atendimento realizado com sucesso!']);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('notify', ['type' => 'warning', 'message' => $exception->getMessage()]);
        }
    }

    public function finishAndOpenTicket()
    {
        try {
            $this->checkStatusAndApply(2);
            $this->extra_service->action = 'Solicitação enviada para o TI.';
            $this->saveExtraServiceMessage($this->extra_service, 'Solicitação enviada para o TI.', true);
            $this->extra_service->save();
            $this->createTicket();
            $this->emit('refresh');
            $this->modalFinish = false;
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Atendimento finalizado e encaminhado para o TI!']);
        } catch (\Exception $exception) {
            $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => $exception->getMessage()]);
        }


    }

    public function render()
    {
        return view('administrativo::livewire.extra-service.dashboard.edit-extra-service');
    }
}
