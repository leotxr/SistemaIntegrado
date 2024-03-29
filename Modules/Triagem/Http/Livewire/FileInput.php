<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Entities\FileType;
use Modules\Triagem\Entities\Sector;
use Modules\Triagem\Entities\Term;
class FileInput extends Component
{
    use WithFileUploads;

    public Term $term;
    public $photo;
    public $file_type;
    public $type = 1;
    public $fileInputModal = false;

    protected $listeners = ['openModal'];
    public function openModal()
    {
        $this->fileInputModal = true;
    }

    public function mount($term)
    {
        $this->term = $term;
        $this->file_type = FileType::all();
    }

    public function save()
    {
        $hoje = date('d-m-Y');
        $triagem = $this->term;
        //dd($this->type);
        $setor = Sector::find($this->term->sector_id);

        $path = $this->photo->storePublicly("storage/termos/$triagem->patient_name/$setor->name/$hoje/arquivo-$triagem->patient_name", ['disk' => 'my_files']);

        $upload = TermFile::updateOrInsert([
            'url' => $path,
            'term_id' => $this->term->id,
            'file_type_id' => $this->type ?? 1,
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
