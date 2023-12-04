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
    public $modalExam = false;
    public $editing;
    public $editing_protocol;
    public $exam_status;
    public $modalDelete = false;
    public $modalUpdate = false;
    public $sortField = 'exams.exam_date';
    public $sortDirection = 'asc';
    public $search = '';
    public $isDisabled;
    public $modalObservacao = false;

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

    public function openEdit($protocol)
    {

        $this->editing = Exam::where('protocol_id', $protocol)->get();
        $this->editing_protocol = Protocol::find($protocol);
        if($this->checkProtocol($this->editing_protocol->id) === false)
        {
            $this->modalExam = true;
            $this->inProcessing($this->editing_protocol->id);
        }
        else
        {
           $user = $this->getUser($this->editing_protocol->id);
            $this->dispatchBrowserEvent(
                'notifyAut',
                ['type' => 'error', 'message' => "O protocolo está sendo utilizado por: "]
            );
        }



        //$this->editing_protocol->recebido == 1 ? $this->isDisabled = true : $this->isDisabled = false;

    }

    public function confirmDelete(Protocol $protocol)
    {
        $this->modalDelete = true;
    }

    public function delete(Protocol $protocol)
    {
        $delete_exam = Exam::where('protocol_id', $protocol->id)->delete();
        $photos = Photo::where('protocol_id', $protocol->id)->get();
        foreach($photos as $photo)
        {
            $delete_path = Storage::deleteDirectory(public_path($photo->url));
            if($delete_path)
            $photo->delete();
        }

        if ($delete_exam)
            $protocol->delete();

        return redirect()->route('autorizacao.index');
    }

    public function showObservacao(Protocol $protocol)
    {
        $this->modalObservacao = true;
        $this->editing_protocol = $protocol;
    }

    public function save()
    {
        //$this->validate();

        foreach ($this->editing as $exam) {
            $exam->updated_by = Auth::user()->id;
            $exam->save();
        }

        if($this->editing_protocol)
        {
            $saving_protocol = $this->editing_protocol;
            $saving_protocol->updated_by = Auth::user()->id;
            $saving_protocol->save();
        }


        $this->modalExam = false;
        $this->modalObservacao = false;
        $this->endByProcotol($this->editing_protocol->id);

    }

    public function close()
    {

        $this->modalExam = false;
        $this->modalObservacao = false;
        $this->endByProcotol($this->editing_protocol->id);
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
