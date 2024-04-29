<?php

namespace Modules\Autorizacao\Http\Livewire\Requests;

use App\Events\AutorizationCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\ExamStatus;
use Modules\Autorizacao\Entities\Photo;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Autorizacao\Traits\ProtocolTraits;

class EditRequest extends Component
{
    use ProtocolTraits;

    public Protocol $editing_protocol;
    public $editing;
    public $modalExam = false;
    public $modalObservation = false;
    public $modalDelete = false;
    public $modalDeleteExam = false;
    public $deleting_exam;

    protected $listeners = [
        'editRequest' => 'openEditRequest'
    ];

    protected $rules = [
        'editing.*.exam_status_id' => 'required',
        'editing.*.exam_obs' => 'max:200',
        'editing_protocol.recebido' => 'boolean',
        'editing_protocol.observacao' => 'string | required',
        'editing.*.exam_date' => 'required',
        'editing.*.name' => 'required',
        'editing.*.convenio' => 'required'
    ];

    public function mount()
    {
        $this->statuses = ExamStatus::orderBy('order_to_show')->get();
    }

    public function getProtocolExams($protocol_id)
    {
        return Exam::where('protocol_id', $protocol_id)->get();
    }

    public function openEditRequest(Protocol $protocol)
    {
        $this->editing_protocol = $protocol;

        if ($this->checkProtocol($this->editing_protocol->id) === false) {
            $this->editing = $this->getProtocolExams($this->editing_protocol->id);
            $this->modalExam = true;
            $this->inProcessing($this->editing_protocol->id);
        } else {
            $user = $this->getUser($this->editing_protocol->id);
            $this->dispatchBrowserEvent(
                'protocol-in-use',
                ['type' => 'error', 'user' => $user->name]
            );
        }
    }

    public function save()
    {
        //$this->validate();

        foreach ($this->editing as $exam) {
            $exam->updated_by = Auth::user()->id;
            $exam->save();
        }

        if ($this->editing_protocol) {
            $saving_protocol = $this->editing_protocol;
            $saving_protocol->recebido = true;
            $saving_protocol->updated_by = Auth::user()->id;
            $saving_protocol->save();
        }


        $this->modalExam = false;
        $this->modalObservation = false;
        $this->endByProcotol($this->editing_protocol->id);
        //AutorizationCreated::dispatch();
        $this->emitUp('refreshParent');

    }

    public function showObservacao(Protocol $protocol)
    {
        $this->modalObservation = true;
        $this->editing_protocol = $protocol;
    }

    public function confirmDelete(Protocol $protocol)
    {
        $this->modalDelete = true;
    }

    public function delete(Protocol $protocol)
    {
        $delete_exam = Exam::where('protocol_id', $protocol->id)->delete();
        $photos = Photo::where('protocol_id', $protocol->id)->get();
        foreach ($photos as $photo) {
            $delete_path = Storage::deleteDirectory(public_path($photo->url));
            if ($delete_path)
                $photo->delete();
        }

        if ($delete_exam)
            $protocol->delete();

        return redirect()->route('autorizacao.index');
    }

    public function openDeleteExam($exam_id)
    {
        if ($this->editing_protocol->exams()->count() <= 1) {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Não foi possível excluir. Este protocolo tem apenas 1 exame.']
            );
        } else {
            $this->deleting_exam = Exam::find($exam_id);
            $this->modalDeleteExam = true;
        }

    }

    public function deleteExam(Exam $exam)
    {
        $this->deleting_exam = $exam;
        if ($this->deleting_exam->delete()) {
            $this->emitUp('refreshParent');
            $this->editing = $this->getProtocolExams($this->editing_protocol->id);
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'success', 'message' => 'Exame excluído com sucesso!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Ocorreu um erro ao excluir o exame.']
            );
        }
        $this->modalDeleteExam = false;

    }

    public function close()
    {
        $this->modalExam = false;
        $this->modalObservation = false;
        $this->endByProcotol($this->editing_protocol->id);
    }


    public function render()
    {

        return view('autorizacao::livewire.requests.edit-request');
    }
}
