<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\FileType;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;

class GenerateFiles extends Component
{
    public $type_id;
    public Term $generatingTerm;
    public FileType $generatingType;
    public $modalFileGenerate = false;
    public $term;

    protected $rules = [
        'generatingTerm.proced' => 'required|min:6',
        'generatingTerm.patient_name' => 'required|min:6'
    ];

    public function generate(Term $term, $type)
    {
        $this->generatingType = FileType::find($type);
        $this->generatingTerm = $term;
        $this->modalFileGenerate = true;
    }

    public function save()
    {
        $signature = TermFile::where('term_id', $this->term->id)->where('file_type_id', 5)->first();
        dd($signature);

    }

    public function render()
    {
        return view('triagem::livewire.generate-files', ['file_types' => FileType::all()]);
    }
}
