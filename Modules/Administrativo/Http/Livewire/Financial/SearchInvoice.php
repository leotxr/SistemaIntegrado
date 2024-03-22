<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use Livewire\Component;

class SearchInvoice extends Component
{
    public $invoice_id = '';

    protected $listeners = ['clearInvoiceId'];

    protected $rules = ['invoice_id' => 'required'];

    public function clearInvoiceId()
    {
        $this->reset();
    }
    public function searchInvoice()
    {
        $this->validate();
        $this->emitUp('searchInvoice', $this->invoice_id);
    }

    public function render()
    {
        return view('administrativo::livewire.financial.search-invoice');
    }
}
