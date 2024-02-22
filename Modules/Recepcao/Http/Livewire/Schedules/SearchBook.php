<?php

namespace Modules\Recepcao\Http\Livewire\Schedules;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchBook extends Component
{
    use WithPagination;
    public $selected_book;
    public $date;

    public function mount()
    {
        $this->date = date('Y-m-d');

    }

    public function search()
    {
        $this->render();
    }

    public function getExams($patient_id)
    {
        $this->emit('getExams', $patient_id);
    }

    public function render()
    {
        return view('recepcao::livewire.schedules.search-book', ['books' => DB::connection('sqlserver')->table('LIVROS')
            ->whereNotIn('LIVROID', [7, 12, 15, 31, 33, 44])
            ->where('UNIDADEID', 1)
            ->select('LIVROID', 'DESCRICAO')
            ->get(),
            'patients' => DB::connection('sqlserver')->table('VW_AGENDA')
                ->where('DATA', date('Y-m-d'))
                ->whereNotNull('NOMEPAC')
                ->where('UNIDADEID', 1)
                ->where('LIVROID', $this->selected_book)
                ->select('DATA', 'PACIENTEID', 'NOMEPAC', 'LIVROID', 'LIVRODESC')
                ->orderBy('NOMEPAC', 'asc')
                ->distinct()
                ->paginate('20')]);
    }
}
