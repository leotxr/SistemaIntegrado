<?php

namespace Modules\Triagem\Http\Livewire\Reports;

use Livewire\Component;
use Modules\Triagem\Entities\Term;
use App\Models\User;
use Modules\Triagem\Entities\Sector;
use Livewire\WithPagination;

class ShowExams extends Component
{
    use WithPagination;
    
    public $initial_date;
    public $final_date;
    public $modalFilters = false;
    public $users;
    public $sectors;
    public $statuses;
    public $enf = [];
    public $sec = [];
    

    public function mount()
    {
        $this->initial_date = date('Y-m-d');
        $this->final_date = date('Y-m-d');
        $this->users = User::permission('criar triagem')->get();
        $this->sectors = Sector::all();
    }

    public function searchFilters()
    {
        $this->modalFilters = true;
    }


    public function render()
    {

        return view('triagem::livewire.reports.show-exams');
    }
}
