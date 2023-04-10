<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ContrastFooter extends Component
{
    public $data_exame;
    public $title;
    public $medico;
    public function mount($data_exame, $title, $medico)
    {
        $this->data_exame = $data_exame;
        $this->title = $title;
        $this->medico = User::permission('medico')->get();
    }
   
    public function render()
    {
        return view('triagem::livewire.contrast-footer');
    }
}
