<?php

namespace Modules\Triagem\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class SignatureField extends Component
{
    public $name;
    public $path;
    public $user;

    public function mount($name, $path, $user)
    {
        $this->name = $name;
        $this->path = $path;
        $this->user = $user;
    }

    public function showSignature()
    {
        $user = User::select('signature')->where('id', $id)->get()->toArray();
        dd($user);
    }
    public function render()
    {
        return view('triagem::livewire.signature-field');
    }
}
