<?php

namespace Modules\Autorizacao\Http\Livewire\Requests\Transactions;

use Livewire\Component;
use Modules\Autorizacao\Entities\Exam;

class ShowTransactions extends Component
{
    public $modalTransactions = false;
    public Exam $exam;

    protected $listeners = ['openModalTransactions', 'refreshParent' => '$refresh'];

    public function openModalTransactions(Exam $exam)
    {
        $this->exam = $exam;
        $this->modalTransactions = true;
    }
    public function render()
    {
        return view('autorizacao::livewire.requests.transactions.show-transactions');
    }
}
