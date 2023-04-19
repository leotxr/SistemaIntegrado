<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ContrastFooter extends Component
{
    public $data_exame;
    public $title;
    public $user_medico;
    public $signature_path;
    public $medico = 'c';
    public $name;
    public $lastname;

    public function mount($data_exame, $title)
    {
        $this->data_exame = $data_exame;
        $this->title = $title;
        $this->user_medico = User::permission('medico')->get();
    }

    public function showSignature()
    {
        $this->signature_path = User::select('signature')->where('id', $this->medico)->first()->signature;
        $this->name = User::select('name')->where('id', $this->medico)->first()->name;
        $this->lastname = User::select('lastname')->where('id', $this->medico)->first()->lastname;

    }
   
    public function render()
    {
        return view('triagem::livewire.contrast-footer');
    }
}
