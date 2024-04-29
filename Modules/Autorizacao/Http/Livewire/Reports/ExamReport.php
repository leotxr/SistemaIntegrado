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
    public $search = '';
    public $sortField = 'paciente_name';
    public $sortDirection = 'desc';
    //public $protocols = [];
    public $initial_date;
    public $end_date;
    public $users;
    public $statuses;
    public $modalFilters = false;
    public $activeStatus = [];
    public $selectedUsers = [];
    public $selectedUpdaters = [];

    public function mount()
    {
        $this->users = User::permission('criar autorizacao')->get();

        $this->statuses = ExamStatus::all();
        foreach ($this->statuses as $status) {
            $this->activeStatus[] = $status->id;
        }

        foreach ($this->users as $user) {
            if($user->createProtocol->count() > 0) $this->selectedUsers[] = $user->id;
            if($user->can('editar autorizacao') && $user->updateProtocol->count() > 0) $this->selectedUpdaters[] = $user->id;
        }
    }

    public function search()
    {
        /*
        $this->protocols = Protocol::search($this->sortField, $this->search)->whereBetween('protocols.created_at', [$this->initial_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->whereIn('user_id', $this->selectedUsers)
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();
        */
        $this->render();
    }

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc'
            : 'desc';

        $this->sortField = $field;
    }

    public function export()
    {
        $range = [
            'initial_date' => $this->initial_date,
            'end_date' => $this->end_date,
            'selected_users' => $this->selectedUsers,
            'selected_updaters' => $this->selectedUpdaters,
            'selected_statuses' => $this->activeStatus
        ];
        return Excel::download(new ExamReportExport($range), 'relatorio-exames-status' . $this->initial_date . '-' . $this->end_date . '.xlsx');
    }

    public function render()
    {
        return view('autorizacao::livewire.reports.exam-report', ['protocols' => Protocol::search($this->sortField, $this->search)
            ->whereBetween('protocols.created_at', [$this->initial_date . ' 00:00:00', $this->end_date . ' 23:59:59'])
            ->whereIn('user_id', $this->selectedUsers)
            ->whereIn('updated_by', $this->selectedUpdaters)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(20)]);
    }
}
