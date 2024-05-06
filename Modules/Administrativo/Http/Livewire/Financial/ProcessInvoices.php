<?php

namespace Modules\Administrativo\Http\Livewire\Financial;

use App\Models\Doctor;

use App\Models\User;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Administrativo\Entities\FinancialInvoice;
use Modules\Administrativo\Exports\Financial\DiscountExamsExport;
use Modules\Administrativo\Traits\InvoiceTraits;

class ProcessInvoices extends Component
{
    /*
 * Componente para processamento de Faturas;
 * Neste componente são retornados os exames em que o usuário seleciona o médico e o período;
 * Utilizado para realizar o cálculo dos valores a serem pagos e descontados de cada médico;
 * Possui também as exportações para PDF e Excel.
 *
 */

    use InvoiceTraits;

    // Importa a trait com as funções de Fatura

    public $doctors;
    public $selected_doctor = 0;
    public $selected_invoices = [];
    public $invoices_discount;
    public $invoices_payment;
    public $total_value_invoices = 0;
    public $payment_value = 0;
    public $discount_value = 0;

    public $liquid_payment_value = 0;
    public $liquid_discount_value = 0;

    public $start_date;
    public $end_date;
    public $discount_percent;
    public $payment_percent;
    public $CheckAllInvoices = false;

    protected $rules = [
        'discount_percent' => 'required',
        'payment_percent' => 'required',
        'invoices_discount' => 'required',
        'invoices_payment' => 'required'
    ];// validações de formulário, todos os campos acima são obrigatórios (required)

    public function mount() // Função de montagem do componente, é executada apenas uma vez (ao abrir a página)
    {
        $this->doctors = Doctor::all(); // Variável doctors recebe todos os médicos
        $this->start_date = date('Y-m-01'); // Data inicial é o primeiro dia do mês atual
        $this->end_date = date('Y-m-t'); // Data final é o último dia do mês atual

    }


    public function calcDiscount() // Função para calcular o desconto no pagamento
    {
        $this->reset('discount_value'); // Reseta a variável de valor do desconto para o valor inicial 0
        $this->invoices_discount = $this->getInvoicesByDoctorAndDate($this->selected_doctor, $this->start_date, $this->end_date); // Busca as faturas importadas pelo médico selecionado e as datas selecionadas no form
        foreach ($this->invoices_discount as $discount) { // Percorre a coleção de faturas gerada anteriormente
            $this->discount_value += $discount->total_value; // Soma todos os valores de cada fatura que será descontada e salva na variável discont_value.
        }
        /*
        foreach ($this->selected_invoices as $selected_invoice) {
            $invoice = FinancialInvoice::find($selected_invoice);
            $this->total_value_invoices += $invoice->total_value;
        }
        */
        $this->liquid_discount_value = ($this->discount_value * $this->discount_percent) / 100;
        // Realiza o cálculo de desconto de acordo com a porcentagem inserida no form e salva na variável liquid_discount_value


    }

    public function calcPayment() // Função para calcular o pagamento
    {
        $this->reset('payment_value'); // Reseta a variável de valor do pagamento para o valor inicial 0
        $this->invoices_payment = $this->getInvoicesByDoctorAndDate($this->selected_doctor, $this->start_date, $this->end_date)->where('payment_enable', true);
        // Busca as faturas importadas pelo médico selecionado, período e apenas as que possuem o atributo "pagamento habilitado", onde o médico vai receber por este exame.
        foreach ($this->invoices_payment as $payment) { // percorre a coleção de faturas
            $this->payment_value += $payment->total_value; // realiza a soma de cada fatura a ser paga
        }
        $this->liquid_payment_value = ($this->payment_value * $this->payment_percent) / 100; // realiza o cálculo de pagamento de acordo com a porcentagem inserida no form
    }

    public function updatedCheckAllInvoices($value) // Função para marcar todas as faturas da tabela (Não está sendo utilizada, mas se precisar está implementada)
    {
        if ($value) { // Se o checkbox for marcado o array selected_invoices recebe todas as faturas que estão na tabela fazendo a mesma query da busca anterior.
            $this->selected_invoices = array_column($this->getInvoicesByDoctorAndDate($this->selected_doctor, $this->start_date, $this->end_date)->toArray(), 'id');
            $this->select();
        } else // se o checkbox for desmarcado, o array de exames selecionados é esvaziado.
            $this->selected_invoices = [];
    }

    public function exportInvoices() // Função de exportação de faturas para Excel
    {
        $this->validate(); // Faz a validação do form
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'doctor' => Doctor::find($this->selected_doctor),
            'invoices' => $this->invoices_discount,
            'discount_value' => $this->discount_value,
            'liquid_discount_value' => $this->liquid_discount_value,
            'discount_percent' => $this->discount_percent,
            'invoices_payment' => $this->invoices_payment,
            'payment_value' => $this->payment_value,
            'liquid_payment_value' => $this->liquid_payment_value,
            'payment_percent' => $this->payment_percent

        ]; // Atribui todas as variáveis necessárias para o array $range
        return Excel::download(new DiscountExamsExport($range), 'desconto-exames-' . $this->start_date . '-' . $this->end_date . '.xlsx');
        // aciona a função download da biblioteca, acessando o controller na pasta Exports/DiscountExamsExport para montar a view e fazer a exportação
    }

    public function exportInvoicesPDF() // Função de exportação de faturas para PDF
    {

        $pdfContent = PDF::loadView('administrativo::financial.exports.pdf-discount-exams-export',
            ['start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'doctor' => Doctor::find($this->selected_doctor),
                'invoices' => $this->invoices_discount,
                'discount_value' => $this->discount_value,
                'liquid_discount_value' => $this->liquid_discount_value,
                'discount_percent' => $this->discount_percent,
                'invoices_payment' => $this->invoices_payment,
                'payment_value' => $this->payment_value,
                'liquid_payment_value' => $this->liquid_payment_value,
                'payment_percent' => $this->payment_percent])
            ->setPaper('a4', 'landscape')->output(); // Seleciona o tipo de papel e orientação
        return response()->streamDownload(
            fn() => print($pdfContent),
            "filename.pdf"
        ); // aciona a biblioteca passando o conteúdo do array $pdfContent e faz o download do arquivo gerado


    }

    public function render()
    {
        return view('administrativo::livewire.financial.process-invoices', [
            'invoices' => $this->getInvoicesByDoctorAndDate($this->selected_doctor, $this->start_date, $this->end_date)
            //Busca as faturas de acordo com o médico selecionado e período.
            // Cada vez que as informações são atualizadas, esta função é executada e atualiza a lista de faturas
        ]);
    }
}
