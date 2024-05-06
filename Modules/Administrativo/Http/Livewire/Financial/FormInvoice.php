<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Administrativo\Entities\FinancialInvoice;
use Illuminate\Support\Facades\Auth;
use Modules\Administrativo\Traits\InvoiceTraits;


class FormInvoice extends Component
{
    use InvoiceTraits;

    public $invoice_id;
    public $invoice;
    public $payment_enable = true;


    protected $listeners = [
        'searchInvoice' => 'searchInvoiceData'
    ];

    protected $rules = [
        'invoice.*' => 'required',
        'invoice.payment_enable' => 'boolean'
    ];

    public function mount()
    {
        //$this->invoice = new FinancialInvoice();
        //$this->saving_invoice = new FinancialInvoice();
    }


    public function searchInvoiceData($invoice_id) // Função para buscar Fatura no servidor X-Clinic e atribuir à variável
    {
      // dd($this->getMaterialValue($invoice_id)->VALORTOTAL);

        $this->invoice_id = $invoice_id; // Variável invoice_id recebe o código da fatura informado

        /*
         *
         */
        if (!$this->getXClinicInvoice($this->invoice_id)) { // Executa a função da Trait buscando o código informado no X-Clinic. Se o código não for encontrado retorna um erro.
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Código de Fatura não encontrado.']
            ); // Retorno do erro
        } else { // Se encontrar a fatura no X-Clinic
            $query = $this->getXClinicInvoice($this->invoice_id); // Variável local query recebe o retorno da função de busca no X-clinic com os dados pré-setados na função
            $query->DESCONTO ? ($discount = $query->DESCONTO) : $discount = 0;
            $this->getMaterialValue($query->FATURA)->VALORTOTAL ? $material = $this->getMaterialValue($query->FATURA)->VALORTOTAL : $material = 0;

            $this->invoice = new FinancialInvoice(); // Variável invoice recebe um novo objeto FinancialInvoice (Fatura) e passa os valores para cada atributo
            $this->invoice->payment_enable = true;
            $this->invoice->invoice_id = $query->FATURA;
            $this->invoice->patient_id = $query->PACIENTE_ID;
            $this->invoice->patient_name = $query->PACIENTE;
            $this->invoice->exam_id = $invoice_id;
            $this->invoice->exam_description = $query->PROCEDIMENTO;
            $this->invoice->exam_date = $query->DATA;
            $this->invoice->insurance = $query->CONVENIO;
            $this->invoice->doctor = $query->MEDICO;
            $this->invoice->doctor_id = Doctor::where('external_id', $query->MEDICO_ID)->first()->id;

            $this->invoice->paid_insurance = ($query->VALOR_CONVENIO + $material);

            $this->invoice->paid_patient = $query->VALOR_PAGO;

            $this->invoice->total_value = ($this->invoice->paid_insurance + $this->invoice->paid_patient) - $discount;

            $this->invoice->processed = 0;
            $this->invoice->requester_id = Auth::user()->id;
            //Após passar todos os valores para os atributos, eles são mostrados na tela de formulário.
        }
    }

    public function saveInvoice() // Função para salvar a fatura criada
    {
        if ($this->invoice->save()) { // Tenta salvar a fatura recebida na variável anteriormente. Caso haja sucesso emite um evento.
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Fatura enviada para processamento!']
            ); // Notificação de sucesso
            $this->reset(); // Reseta todas as variáveis da classe para uma nova fatura.
            $this->emit('clearInvoiceId'); // Emite um evento para limpar as variáveis.
        } else { // Se não salvar, emite uma notificação de erro mas não atualiza a página, o usuário pode corrigir.

            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao enviar a fatura.']
            ); // Notificação de erro.
        }

    }


    public function render()
    {

        return view('administrativo::livewire.financial.form-invoice');
    }
}
