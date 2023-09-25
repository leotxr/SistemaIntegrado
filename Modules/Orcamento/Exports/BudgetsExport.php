<?php

namespace Modules\Orcamento\Exports;

use Modules\Orcamento\Entities\Budget;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BudgetsExport implements FromView
{
    use Exportable;

    public $start;
    public $end;

    public function __construct($range)
    {
        $this->start = $range['initial_date'];
        $this->end = $range['final_date'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view(
            'orcamento::reports.tables.table-changed-budgets',
            ['orcamentos' => Budget::whereColumn('updated_at', '>', 'created_at')
                ->whereBetween('budget_date', [$this->start, $this->end])
                ->get()]
        );
    }
}
