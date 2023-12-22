<?php

namespace Modules\NC\Http\Livewire\User;

use App\Models\UserGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\NC\Entities\NCClassification;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Dashboard extends Component
{
    use WithPagination;

    public $start_date;
    public $end_date;

    protected $listeners = [
        'refreshChildren' => 'refreshMe',
        'refreshParent' => '$refresh'
    ];

    public function mount()
    {
        $this->start_date = now()->subDays(30);
        $this->end_date = date('Y-m-d');
    }

    public function refreshMe($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;

        $this->render();
    }

    public function export()
    {

    }


    public function render()
    {
        if (auth()->user()->can('editar ncs') || auth()->user()->can('excluir ncs'))
            return view('nc::livewire.user.dashboard', ['ncs' => NonConformity::whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at')->paginate(10)]);
        else
            return view('nc::livewire.user.dashboard', ['ncs' => NonConformity::whereBetween('n_c_date', [$this->start_date, $this->end_date])->where('source_user_id', Auth::user()->id)->orderBy('created_at')->paginate(10)]);
    }
}
