<?php

namespace Modules\Triagem\Http\Livewire\Questionario;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Modules\Triagem\Entities\Question;
use Modules\Triagem\Entities\Term;
use Illuminate\Support\Facades\Auth;
use Modules\Triagem\Entities\Sector;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Traits\WorkListQueries;

class TCQuestionnaire extends Component
{
    use WorkListQueries;

    public $patient_id;
    public $sector_id;
    public $sector_xclinic;
    public $perguntas;
    public $saving;
    public $observation;
    public $questions = [];
    public $question;

    protected $rules = [
      'question.*.answer' => 'required',
      'question.*.observation' => 'max:220'
    ];

    public function mount($patient_id, $sector_id)
    {
        $this->patient_id = $patient_id;
        $this->sector_id = $sector_id;
        $this->perguntas = Question::where('sector_id', 2)->where('file_type_id', 6)->get();
        foreach($this->perguntas as $pergunta)
        {
            $this->questions[] = (object)['id' => $pergunta->id, 'question' => $pergunta->description, 'answer' => 'Não', 'observation' => NULL];
        }


    }

    public function save()
    {

        $today = date('d-m-Y');
        $setor = Sector::where('id', $this->sector_id)->first();
        $query= $this->getPatient($this->patient_id, $setor->xclinic_id);
        $this->saving = Term::create([
            'patient_name' => $query->NOME ?? NULL,
            'patient_id' => $query->PACIENTEID ?? NULL,
            'user_id' => Auth::user()->id ?? NULL,
            'patient_age' => date('Y-m-d', strtotime($query->DATANASC)) ?? NULL,
            'proced' => $query->DESCRICAO ?? NULL,
            'start_hour' => date('H:i:s', strtotime(now())),
            'exam_date' => date('Y-m-d'),
            'sector_id' => $setor->id,
            'finished' => 0,
            'observation' => $this->observation
        ]);



        $pdf = PDF::loadView('triagem::PDF.pdf-questionario', ['collection' => $this->questions, 'title' => "Questionário para realização de Tomografia Computadorizada", 'term' => $this->saving]);
        $save = Storage::disk('my_files')->put("storage/termos/" . $this->saving->patient_name . "/" . $setor->name . "/" . $today . "/questionario-" . $this->saving->patient_name . ".pdf", $pdf->output());
        $path = "storage/termos/" . $this->saving->patient_name . "/" . $setor->name . "/" . $today . "/questionario-" . $this->saving->patient_name . ".pdf";

        if ($path) {
            TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $this->saving->id,
                'file_type_id' => 6
            ]);
        } else return redirect()->back()->with('error', 'Ocorreu um erro!');

        if($save)
        return redirect()->to('/triagem/setor/tomografia');

    }

    public function render()
    {
        $setor = Sector::where('id', $this->sector_id)->first();
        return view('triagem::livewire.questionario.t-c-questionnaire', ['patient' => $this->getPatient($this->patient_id, $setor->xclinic_id)]);
    }
}
