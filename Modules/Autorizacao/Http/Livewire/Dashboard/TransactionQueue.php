<?php

namespace Modules\Autorizacao\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\ExamEvent;

class TransactionQueue extends Component
{
    use WithPagination;

    public $selected_status = 5;
    public $selected_event_show;
    public $selectAllExams = false;
    public $selected_exams = [];
    public $sort_field = 'exam_id';
    public $sort_direction = 'asc';
    public $search = '';

    protected $listeners = ['refreshParent' => '$refresh'];


    public function updatedselectAllExams($value)
    {
        if ($value) {
            $this->selected_exams = $this->getExams()->get()->pluck('exam_id');

        } else
            $this->reset('selected_exams');
    }

    public function selectStatus($value)
    {
        $this->reset('selected_exams', 'selectAllExams');
        $this->selected_status = $value;
    }

    public function sendTo($value)
    {
        if (!$this->selected_exams) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'warning', 'message' => 'Não existem exames selecionados']
            );
        } else {

            $event = ExamEvent::find($value);
            foreach ($this->selected_exams as $selected_exam) {
                $exam = Exam::find($selected_exam);
                $exam->events()->sync([$event->id => ['user_id' => auth()->user()->id, 'created_at' => now()]], true);
            }
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Exames transferidos com sucesso!']
            );
        }


    }

    public function sortBy($field)
    {

        $this->sort_direction = $this->sort_field === $field
            ? $this->sort_direction = $this->sort_direction === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sort_field = $field;
    }


    public function getExams()
    {
        return Exam::search($this->sort_field, $this->search)
            ->join('protocols', 'exams.protocol_id', '=', 'protocols.id')
            ->join('exam_event_users', 'exam_event_users.exam_id', '=', 'exams.id')
            ->join('exam_statuses', 'exam_statuses.id', '=', 'exams.exam_status_id')
            ->where('exam_event_users.exam_event_id', $this->selected_status)
            ->selectRaw('exams.id as exam_id, exams.exam_date as exam_date, protocols.paciente_name as paciente_name, exams.name as exam_name, exam_statuses.name as status_name')
            ->orderBy($this->sort_field, $this->sort_direction)
            ->whereDate('exam_event_users.created_at', '>', now()->subDays(60));

    }

    private function getEvents()
    {
        $events = ExamEvent::orderBy('order_to_show', 'asc')->get();
        $return = [];

        foreach($events as $event)
        {
            
        }
    }

    public function render()
    {
        $this->selected_event_show = ExamEvent::find($this->selected_status);
        return view('autorizacao::livewire.dashboard.transaction-queue', ['events' => ExamEvent::orderBy('order_to_show', 'asc')->get(),
            'exams' => $this->getExams()->paginate(10)

        ]);

    }
}
