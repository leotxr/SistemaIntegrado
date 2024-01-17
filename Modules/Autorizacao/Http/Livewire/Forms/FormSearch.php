<?php

namespace Modules\Autorizacao\Http\Livewire\Forms;

use App\Events\AutorizationCreated;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Photo;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Autorizacao\Traits\ProtocolTraits;

class FormSearch extends Component
{
    use WithFileUploads;
    use ProtocolTraits;


    public $dadosSolicitacao = false;
    public Protocol $protocol;
    public $protocol_search;
    //public $show_data_protocol;
    public $photo;
    public $photos = [];
    public $formProtocol = true;
    public Collection $inputs;
    public $exams = [];
    public $patient;
    public $exam;

    protected $rules = [
        'protocol' => 'required|min:6',
        'protocol.paciente_id' => 'required',
        'protocol.paciente_name' => 'required',
        'protocol.created_by' => 'required',
        'protocol.user_id' => 'required',
        'protocol.observacao' => 'max:220',

        'exam.*.name' => 'required',
        'exam.*.exam_date' => 'required',
        'exam.*.convenio' => 'required',
        'exam.*.exam_cod' => 'required'
    ];

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['email' => '']]),
        ]);
        $this->protocol = new Protocol();
        $this->exams = collect([]);
        $this->exam = [];
    }

    public function addInput()
    {
        $this->inputs->push(['exam' => '']);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photos.*' => 'file|mimes:png,jpg,pdf',
        ]);
    }


    public function search()
    {
        $this->mount();
        $query = $this->getProtocol($this->protocol_search);

        if ($query->count() != 0) {
            $patient = $query->first();

            $exams = $this->getExamsByProtocol($this->protocol_search);

            $this->protocol->paciente_id = $patient->PACIENTEID;
            $this->protocol->paciente_name = $patient->NOMEPAC;

            foreach ($exams as $exam) {
                $this->exams[] = new Exam(['name' => $exam->NOME_PROCEDIMENTO, 'exam_date' => $exam->DATA, 'protocol_id' => $this->protocol->id, 'convenio' => $exam->CONVDESC, 'exam_cod' => $exam->CODIGO, 'updated_by' => Auth::user()->id]);

            }

        } else {
            $this->mount();
            $this->dispatchBrowserEvent(
                'notify',
                ['type' => 'error', 'message' => 'Protocolo inválido! Tente novamente.']
            );
        }
    }

    public function save()
    {
        $this->protocol->created_by = Auth::user()->name;
        $this->protocol->user_id = Auth::user()->id;
        $this->protocol->updated_by = Auth::user()->id;
        $save_protocol = $this->protocol->save();

        if (!$save_protocol) {
            $notification = array(
                'message' => 'Ocorreu um erro ao salvar a solicitação.',
                'alert-type' => 'error'
            );
            return redirect()->to('/autorizacao/nova-solicitacao')->with($notification);
        }

        if ($this->formProtocol) {
            foreach ($this->exams as $exam) {
                if (!$this->saveExam($exam)) {
                    $notification = array(
                        'message' => 'Ocorreu um erro ao salvar a solicitação.',
                        'alert-type' => 'error'
                    );
                    return redirect()->to('/autorizacao/nova-solicitacao')->with($notification);
                }
            }
        } else {
            foreach ($this->exam as $exam) {
                if (!$this->saveExam($exam)) {
                    $notification = array(
                        'message' => 'Ocorreu um erro ao salvar a solicitação.',
                        'alert-type' => 'error'
                    );
                    return redirect()->to('/autorizacao/nova-solicitacao')->with($notification);
                }
            }
        }

        foreach ($this->photos as $photo) {
            $path = $photo->storePublicly("storage/fotos_pedidos/" . $this->protocol->id, ['disk' => 'my_files']);
            $upload = Photo::updateOrInsert([
                'url' => $path,
                'protocol_id' => $this->protocol->id,
            ]);
        }

        $notification = array(
            'message' => 'Solicitação salva com sucesso!',
            'alert-type' => 'success'
        );
        return redirect()->to('/autorizacao/nova-solicitacao')->with($notification);

    }


    public function render()
    {

        return view('autorizacao::livewire.forms.form-search');

    }
}
