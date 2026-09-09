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
    public $updaters;
    public $dateField;

    public function __construct($range)
    {
        $this->start = $range['initial_date'];
        $this->end = $range['end_date'];
        $this->users = $range['selected_users'];
        $this->updaters = $range['selected_updaters'];
        $this->activeStatus = $range['selected_statuses'];
        $this->dateField = $range['date_field'] ?? 'created_at';
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $dateColumn = $this->dateField === 'updated_at' ? 'protocols.updated_at' : 'protocols.created_at';

        return view(
            'autorizacao::tables.table-exam-export',
            ['protocols' => Protocol::whereBetween($dateColumn, [$this->start . ' 00:00:00', $this->end . ' 23:59:59'])
                ->whereIn('user_id', $this->users)
                ->whereIn('updated_by', $this->updaters)
                ->get(), 'activeStatus' => $this->activeStatus]
        );
    }
}
