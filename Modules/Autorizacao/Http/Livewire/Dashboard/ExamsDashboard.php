<?php

namespace Modules\Autorizacao\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Autorizacao\Entities\ExamStatus;
use Modules\Autorizacao\Entities\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Modules\Autorizacao\Traits\ProtocolTraits;

class ExamsDashboard extends Component
{
    use WithPagination;
    use ProtocolTraits;
    //public $selectedStatus = [];
    public $activeStatus = 6;
    public $sortField = 'exams.exam_date';
    public $sortDirection = 'asc';
    public $search = '';
    public $isDisabled;

    protected $rules = [
        'editing.*.exam_status_id' => 'required',
        'editing.*.exam_obs' => 'max:200',
        'editing_protocol.recebido' => 'boolean',
        'editing_protocol.observacao' => 'string | required',
        'editing.*.exam_date' => 'required',
        'editing.*.name' => 'required',
        'editing.*.convenio' => 'required'
    ];

    protected $listeners = [
        'echo:autorization-dashboard,AutorizationCreated' => '$refresh',
        'refreshParent' => '$refresh'
    ];


    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
    }


    public function selectStatus($status_id)
    {
        $status = ExamStatus::find($status_id);
        $this->activeStatus = $status->id;
        //$this->selectedStatus =
    }

    public function render()
    {
        $statuses = ExamStatus::all();
        $sorted = $statuses->sortBy('order_to_show');

        if ($this->activeStatus == 1 || $this->activeStatus == 4) {
            return view('autorizacao::livewire.dashboard.exams-dashboard', ['statuses' => $sorted->all(), 'selectedStatus' => Protocol::search($this->sortField, $this->search)->join('exams', 'exams.protocol_id', '=', 'protocols.id')
                ->where('exam_status_id', $this->activeStatus)
                ->whereDate('exams.updated_at', date('Y-m-d'))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)]);
        } else {
            return view('autorizacao::livewire.dashboard.exams-dashboard', ['statuses' => $sorted->all(), 'selectedStatus' => Protocol::search($this->sortField, $this->search)->join('exams', 'exams.protocol_id', '=', 'protocols.id')
                ->where('exam_status_id', $this->activeStatus)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)]);
        }
    }
}
