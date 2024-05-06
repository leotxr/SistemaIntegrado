<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use Livewire\Component;
use Modules\Administrativo\Entities\FinancialInvoice;

class EditInvoice extends Component
{
    public $modalEdit = false; // Modal inicia fechado
    public FinancialInvoice $editing_invoice; // Variável atribuída para edição da fatura é do tipo FinancialInvoice (Fatura)

    protected $listeners = ['editInvoice' => 'edit']; // Escuta o evento editInvoice e aciona a função edit que abre o modal e carrega a fatura para a variável de edição.
    protected $rules = ['editing_invoice.payment_enable' => 'required']; // Regras de formulário. <Campo> => <Validação>

    public function edit(FinancialInvoice $invoice) // Função editar a fatura, recebe o objeto fatura como parâmetro
    {
        $this->editing_invoice = $invoice; // Variável global atribuída para edição recebe a fatura passada no parâmetro.
        $this->modalEdit = true; // Abre o modal após carregar o objeto.
    }

    public function save() // Função salvar a fatura. Ainda não foi implementada a validação e notificação.
    {
        $this->editing_invoice->save(); // Salva a fatura editada
        $this->modalEdit = false; // Fecha o modal após salvar
    }

    public function render()
    {
        return view('administrativo::livewire.financial.edit-invoice');
    }
}
