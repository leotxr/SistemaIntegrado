<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Entities\FileType;

class FileInput extends Component
{
    use WithFileUploads;

    public $term;
    public $photo;
    public $file_type;
    public $type;

    public function mount()
    {
        $this->file_type = FileType::all();
    }

    public function save()
    {
        $hoje = date('d-m-Y');
        $triagem = $this->term;
        //dd($this->type);
        $path = $this->photo->storePublicly("storage/termos/$triagem->patient_name/RM/$hoje/arquivo-$triagem->patient_name", ['disk' => 'my_files']);
        
        $upload = TermFile::updateOrInsert([
            'url' => $path,
            'term_id' => $this->term->id,
            'file_type_id' => $this->type,
            //'description' => $request->observacoes
        ]);

        if($upload)
        {
            session()->flash('message', 'Arquivo importado com sucesso!');
            $this->term->refresh();
        }
        

    }
    public function render()
    {
        return view('triagem::livewire.file-input');
    }
}
