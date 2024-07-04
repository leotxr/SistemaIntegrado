<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Trix extends Component
{
    const EVENT_VALUE_UPDATED = 'trix_value_updated';
    public $value;
    public $trixId;

    public function mount($value = ''){
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updatedvalue($value){
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function render()
    {
        return view('livewire.components.trix');
    }
}
