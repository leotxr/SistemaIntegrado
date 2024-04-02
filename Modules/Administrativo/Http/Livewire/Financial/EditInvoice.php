<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use Livewire\Component;
use Modules\Administrativo\Entities\FinancialInvoice;

class EditInvoice extends Component
{
    public $modalEdit = false;
    public FinancialInvoice $editing_invoice;

    protected $listeners = ['editInvoice' => 'edit'];
    protected $rules = ['editing_invoice.payment_enable' => 'required'];

    public function edit(FinancialInvoice $invoice)
    {
        $this->editing_invoice = $invoice;
        $this->modalEdit = true;
    }

    public function save()
    {
        $this->editing_invoice->save();
        $this->modalEdit = false;
    }

    public function render()
    {
        return view('administrativo::livewire.financial.edit-invoice');
    }
}
