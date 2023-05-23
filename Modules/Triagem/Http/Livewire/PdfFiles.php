<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Modules\Triagem\Entities\FileType;
use Modules\Triagem\Entities\Sector;

class PdfFiles extends Component
{
    public $color;
    public $title;
    public $description;
    public $sign;
    public $term;
    public $file_type;
    public $wire_function;
    public $start_time;
    public $modalFile = false;
    public $signature;
    public $file;

    public function mount($title, $description, $sign, $wire_function)
    {
        if ($sign !== 1) {
            $this->color = 'gray';
            $this->title = $title;
            $this->description = $description;
            $this->wire_function = $wire_function;
        } else {
            $this->color = 'green';
            $this->title = $title;
            $this->description = "Documento Gerado/Assinado";
            $this->wire_function = $wire_function;
        }

        $this->start_time = date('Y-m-d H:i:s');
    }

    public function generate_pdf_contrast()
    {
        $this->modalFile = false;

        $hoje = date('d-m-Y');
        $current_time = date('Y-m-d H:i:s');
        $triagem = $this->term;

        $setor = Sector::find($this->term->sector_id);

        $this->signature = TermFile::where('term_id', $this->term->id)->where('file_type_id', 5)->first();

        if($setor->id == 1)
        $pdf = PDF::loadView('triagem::PDF.pdf-ressonancia', ['term' => $this->term, 'signature' => $this->signature]);
        else
        $pdf = PDF::loadView('triagem::PDF.pdf-tomografia', ['term' => $this->term, 'signature' => $this->signature]);
        
        //salva pdf
        $save = Storage::disk('my_files')->put("storage/termos/$triagem->patient_name/$setor->name/$hoje/termo-contraste-$triagem->patient_name.pdf", $pdf->output());
        //busca diretório
        $path = "storage/termos/$triagem->patient_name/$setor->name/$hoje/termo-contraste-$triagem->patient_name.pdf";

        $time = gmdate('H:i:s', strtotime($current_time) - strtotime($this->start_time));

        // dd(gmdate('i:s', strtotime($this->term->time_spent) + strtotime($time)));

        if ($save) {
            TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $this->term->id,
                'file_type_id' => $this->file_type,
            ]);

            $term = Term::find($this->term->id);
            $term->contrast_term = 1;
            $term->time_spent = gmdate('i:s', strtotime($this->term->time_spent) + strtotime($time));
            $term->save();

            $this->color = 'green';
            $this->description = "Documento Gerado/Assinado";
        } else {
            $this->color = 'red';
            $this->description = "Ocorreu um erro ao gerar o arquivo.";
        }
    }

    public function generate_pdf_report()
    {
        $this->modalFile = false;

        $hoje = date('d-m-Y');
        $current_time = date('Y-m-d H:i:s');
        $triagem = $this->term;

        $setor = Sector::find($this->term->sector_id);

        //puxa assinatura do paciente
        $signature = TermFile::where('term_id', $this->term->id)->where('file_type_id', 5)->first();

        //cria pagina do pdf
        $pdf = PDF::loadView('triagem::PDF.pdf-telelaudo', ['term' => $this->term, 'signature' => $signature]);

        //salva pdf
        $save = Storage::disk('my_files')->put("storage/termos/$triagem->patient_name/$setor->name/$hoje/termo-telelaudo-$triagem->patient_name.pdf", $pdf->output());
        //busca diretório
        $path = "storage/termos/$triagem->patient_name/$setor->name/$hoje/termo-telelaudo-$triagem->patient_name.pdf";

        $time = gmdate('H:i:s', strtotime($current_time) - strtotime($this->start_time));

        if ($save) {
            TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $this->term->id,
                'file_type_id' => $this->file_type,
            ]);

            $term = Term::find($this->term->id);
            $term->tele_report = 1;
            $term->time_spent = gmdate('i:s', strtotime($this->term->time_spent) + strtotime($time));
            $term->save();

            $this->color = 'green';
            $this->description = "Documento Gerado/Assinado";
        } else {
            $this->color = 'red';
            $this->description = "Ocorreu um erro ao gerar o arquivo.";
        }
    }

    public function render()
    {
        return view('triagem::livewire.pdf-files');
    }
}
