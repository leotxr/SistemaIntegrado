<?php

namespace Modules\Autorizacao\Http\Livewire\Reports;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Autorizacao\Entities\ExamStatus;
use Modules\Autorizacao\Exports\ExamReportExport;

class ExamReport extends Component
{
    use WithPagination;
    public $db;
    public $protocols = [];
    public $initial_date;
    public $end_date;
    public $users;
    public $statuses;
    public $modalFilters = false;
    public $activeStatus = [];
    public $selectedUsers = [];

    public function mount()
    {
        $this->users = User::permission('criar autorizacao')->get();
        $this->statuses = ExamStatus::all();
        foreach ($this->statuses as $status) {
            $this->activeStatus[] = $status->id;
        }

        foreach ($this->users as $user) {
            $this->selectedUsers[] = $user->id;
        }
    }

    public function search()
    {
        $this->protocols = Protocol::whereBetween('protocols.created_at', [$this->initial_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->whereIn('user_id', $this->selectedUsers)->get();
    }

    public function export()
    {
        $range = [
            'initial_date' => $this->initial_date,
            'end_date' => $this->end_date,
            'selected_users' => $this->selectedUsers,
            'selected_statuses' => $this->activeStatus
        ];
        return Excel::download(new ExamReportExport($range), 'relatorio-exames-status' . $this->initial_date . '-' . $this->end_date . '.xlsx');
    }

    public function render()
    {
        return view('autorizacao::livewire.reports.exam-report');
    }
}
