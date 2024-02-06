<?php

namespace Modules\NC\Http\Livewire\Reports;

use App\Models\UserGroup;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Modules\NC\Entities\NonConformity;
use Modules\NC\Exports\Dashboard\NonConformityExport;
use Modules\NC\Exports\Reports\ReceivedBySectorExport;

class ReceivedBySector extends Component
{
    public $start_date;
    public $end_date;
    public $group;
    public $modalSectors = false;
    public $selectedSector;
    public $ncs;


    public function mount()
    {

        //dd($group->groupNonConformities()->whereBetween('n_c_date', ['2024-02-01', '2024-02-05'])->get());

    }

    public function search()
    {
        //$this->group = UserGroup::find($this->selectedSector);

        $this->ncs = $this->group->groupNonConformities->whereBetween('n_c_date', [$this->start_date, $this->end_date]);


    }

    public function setSector()
    {
        $this->group = UserGroup::find($this->selectedSector);
        $this->modalSectors = false;

    }

    public function export()
    {
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'group' => $this->group
        ];
        return Excel::download(new ReceivedBySectorExport($range), 'nao-conformidades-setor-' . $this->group->name . '-' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function render()
    {
        return view('nc::livewire.reports.received-by-sector', ['groups' => UserGroup::all()]);
    }
}
