<?php

namespace Modules\Triagem\Http\Livewire\Termos\Files;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\FileType;
use Modules\Triagem\Entities\Sector;
use Modules\Triagem\Entities\TermFile;

class CreateFiles extends Component
{
    use WithFileUploads;
    public Term $triagem;
    public $photo;
    public $type;
    public $showing;
    public $showing_url;
    public $showModal = false;


    public function mount($triagem)
    {
        $this->triagem = $triagem;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image',
        ]);
    }

    public function save()
    {
        $hoje = date('d-m-Y');
        $triagem = $this->triagem;
        //dd($this->type);
        $setor = Sector::find($this->triagem->sector_id);

        $path = $this->photo->storePublicly("storage/termos/$triagem->patient_name/$setor->name/$hoje/arquivo-$triagem->patient_name", ['disk' => 'my_files']);
        
        $upload = TermFile::updateOrInsert([
            'url' => $path,
            'term_id' => $this->triagem->id,
            'file_type_id' => $this->type,
            //'description' => $request->observacoes
        ]);

        if($upload)
        {
            session()->flash('message', 'Arquivo importado com sucesso!');
            $this->render();
        }
        

    }

    public function show($termFileId)
    {
        $this->showing = TermFile::find($termFileId);
        $this->showing_url = $this->showing->url;
        $this->showModal = true;
    }

    public function render()
    {
        return view('triagem::livewire.termos.files.create-files', [
            'file_type' => Filetype::all(),
            'term_photos' => TermFile::where('term_id', '=', $this->triagem->id)->get()
        ]);
    }
}
