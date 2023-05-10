<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;

class ShowFiles extends Component
{
    public $term;
    public $photos;
    public $showModal = false;
    public $showing;
    public $showing_url;

    protected $rules = [
        'showing.url' => 'required',
    ];

    public function mount()
    {
        $this->photos = TermFile::where('term_id', '=', $this->term->id)->get();
    }

    public function show($termFileId)
    {
        $this->showing = TermFile::find($termFileId);
        $this->showing_url = $this->showing->url;
        $this->showModal = true;
    }

    public function render()
    {
        return view('triagem::livewire.show-files', ['photos' => TermFile::where('term_id', '=', $this->term->id)->get()]);
    }
}
