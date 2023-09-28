<?php

namespace Modules\Orcamento\Exports;

use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TotalizerBudgetsExport implements FromView
{
    use Exportable;

    public $initial_date;
    public $final_date;

    public function __construct($range)
    {
        $this->initial_date = $range['initial_date'];
        $this->final_date = $range['final_date'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('orcamento::reports.tables.table-totalizer-budgets', [
            'statuses' => BudgetStatus::all(),
            'orcamentos' => Budget::whereBetween('budget_date', [$this->initial_date, $this->final_date])
                ->get(),
            'users' => User::permission('criar orcamento')->orderBy('name', 'ASC')->get(),
            'initial_date' => $this->initial_date,
            'final_date' => $this->final_date
        ]);
    }
}
