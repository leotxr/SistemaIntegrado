<?php

namespace Modules\Autorizacao\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Autorizacao\Entities\Protocol;

class ExamReportExport implements FromView
{
    use Exportable;

    public $start;
    public $end;
    public $users;
    public $statuses;

    public function __construct($range)
    {
        $this->start = $range['initial_date'];
        $this->end = $range['end_date'];
        $this->users = $range['selected_users'];
        $this->activeStatus = $range['selected_statuses'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view(
            'autorizacao::tables.table-exam-export',
            ['protocols' => Protocol::whereBetween('protocols.created_at', [$this->start . ' 00:00:00', $this->end . ' 23:59:59'])
                ->whereIn('user_id', $this->users)->get(), 'activeStatus' => $this->activeStatus]
        );
    }
}
