<?php

namespace Modules\Triagem\Http\Livewire\Tables;

use Livewire\Component;
use Modules\Triagem\Entities\Term;
use Livewire\WithPagination;

class TableTriagem extends Component
{
    use WithPagination;

    public $modalTriagem = false;
    public Term $editing;
    public $observation;
    public Term $saving;
    public $triagem;
    public $sector;

    protected $rules = [
        'editing.start_hour' => 'required | readonly',
        'editing.final_hour' => 'time',
        'editing.observation' => 'required',
        'editing.finished' => 'boolean',
        'editing.patient_name' => 'required'
    ];

    public function mount(Term $term, $sector)
    {
        $this->editing = $term;
        $this->sector = $sector;
    }

    

    public function editTerm(Term $term)
    {
        $this->editing = $term;
        $this->modalTriagem = true;
    }

    public function save(Term $term)
    {

        $this->saving = $term;

        $this->saving->observation = $this->editing->observation;
        $this->saving->finished = $this->editing->finished;
        if($this->editing->finished)
        $this->saving->final_hour = date('H:i:s');

        $this->saving->save();

        $this->modalTriagem = false;
        session()->flash('message', 'Triagem atualizada com sucesso!');
    }

    public function setEnd()
    {
        $this->editing->final_hour = date('H:i:s');
    }


    public function render()
    {
        return view('triagem::livewire.tables.table-triagem', [
            'terms' => Term::Where('sector_id', $this->sector->id)
            ->whereDate('exam_date', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->paginate(8),
        ]);


    }
}
