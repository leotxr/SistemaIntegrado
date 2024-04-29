<?php

namespace Modules\Autorizacao\Http\Livewire\Requests\Transactions;

use Livewire\Component;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\ExamEvent;

class NewTransaction extends Component
{
    public $selected_event = '';
    public $observation;
    public $transaction;
    public $modalNewTransaction = false;
    public Exam $target_exam;
    public $show = false;

    protected $listeners = ['newTransaction' => 'openNewTransaction'];
    protected $rules = ['observation' => 'nullable', 'selected_event' => 'required'];
    protected $messages = ['selected_event.required' => 'O evento é obrigatório.'];


    public function openNewTransaction(Exam $target_exam)
    {
        $this->reset('observation', 'selected_event');
        $this->target_exam = $target_exam;
        $this->modalNewTransaction = true;
    }


    public function save()
    {
        $this->validate();
        if ($this->target_exam->events()->sync([$this->selected_event => ['user_id' => auth()->user()->id, 'observation' => $this->observation, 'created_at' => now()]], true)) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Exame transferido com sucesso!']
            );
            $this->emitUp('refreshParent');
            $this->modalNewTransaction = false;
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao transferir o exame.']
            );
        }

    }

    public function render()
    {
        return view('autorizacao::livewire.requests.transactions.new-transaction', ['events' => ExamEvent::where('active', 1)->get()]);
    }
}
