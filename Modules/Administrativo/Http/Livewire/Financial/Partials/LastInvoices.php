<?php

namespace Modules\Administrativo\Http\Livewire\Financial\Partials;

use Livewire\Component;
use Modules\Administrativo\Traits\InvoiceTraits;

class LastInvoices extends Component
{
    use InvoiceTraits; // Importa o arquivo de Traits para usar as funções

    public function render()
    {
        return view('administrativo::livewire.financial.partials.last-invoices', [
            'invoices' => $this->getNInvoices(5) // Busca as últimas 5 faturas importadas (usando a trait)
        ]);
    }
}
