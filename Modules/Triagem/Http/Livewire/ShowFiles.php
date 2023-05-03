<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;

class ShowFiles extends Component
{
    public $term;
    public $photos;

    public function mount()
    {
        $this->photos = TermFile::where('term_id', '=', $this->term->id)->get();
    }

    public function render()
    {
        return view('triagem::livewire.show-files');
    }
}
