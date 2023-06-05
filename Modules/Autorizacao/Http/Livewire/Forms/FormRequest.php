<?php

namespace Modules\Autorizacao\Http\Livewire\Forms;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FormRequest extends Component
{
    public $show_data_protocol;

    public function mount($show_data_protocol)
    {
        $this->show_data_protocol = $show_data_protocol;
    }
   
    public function render()
    {
        return view('autorizacao::livewire.forms.form-request');
    }
}
