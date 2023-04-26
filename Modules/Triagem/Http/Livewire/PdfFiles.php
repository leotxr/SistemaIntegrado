<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfFiles extends Component
{
    public $color;
    public $title;
    public $description;
    public $sign;
    public $term;
    public $file_type;
    public $wire_function;

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

       

    }

    public function generate_pdf_contrast()
    {
        $hoje = date('d-m-Y');
        $triagem = $this->term;
        
        //puxa assinatura do paciente
        $signature = TermFile::where('term_id', $this->term->id)->where('file_type_id', 5)->first();
        
        //cria pagina do pdf
        $pdf = PDF::loadView('triagem::PDF.pdf-ressonancia', ['term' => $this->term, 'signature' => $signature]);
        //salva pdf
        $save = Storage::disk('my_files')->put("storage/termos/$triagem->patient_name/RM/$hoje/termo-contraste-$triagem->patient_name.pdf", $pdf->output());
        //busca diretório
        $path = "storage/termos/$triagem->patient_name/RM/$hoje/termo-contraste-$triagem->patient_name.pdf";


        if ($save) {
            TermFile::create([
                'url' => $path,
                'term_id' => $this->term->id,
                'file_type_id' => $this->file_type,
            ]);

            $term = Term::find($this->term->id);
            $term->contrast_term = 1;
            $term->save();

            $this->color = 'green';
            $this->description = "Documento Gerado/Assinado";
        }else
        {
            $this->color = 'red';
            $this->description = "Ocorreu um erro ao gerar o arquivo.";
        }


        //return $pdf->download('teste.pdf');
    }

    public function generate_pdf_report()
    {
        $hoje = date('d-m-Y');
        $triagem = $this->term;

        //puxa assinatura do paciente
        $signature = TermFile::where('term_id', $this->term->id)->where('file_type_id', 5)->first();

        //cria pagina do pdf
        $pdf = PDF::loadView('triagem::PDF.pdf-telelaudo', ['term' => $this->term, 'signature' => $signature]);

        //salva pdf
        $save = Storage::disk('my_files')->put("storage/termos/$triagem->patient_name/RM/$hoje/termo-telelaudo-$triagem->patient_name.pdf", $pdf->output());
        //busca diretório
        $path = "storage/termos/$triagem->patient_name/RM/$hoje/termo-telelaudo-$triagem->patient_name.pdf";


        if ($save) {
            TermFile::create([
                'url' => $path,
                'term_id' => $this->term->id,
                'file_type_id' => $this->file_type,
            ]);

            $term = Term::find($this->term->id);
            $term->tele_report = 1;
            $term->save();

            $this->color = 'green';
            $this->description = "Documento Gerado/Assinado";
        }else
        {
            $this->color = 'red';
            $this->description = "Ocorreu um erro ao gerar o arquivo.";
        }


        //return $pdf->download('teste.pdf');
    }

    public function render()
    {
        return view('triagem::livewire.pdf-files');
    }
}
