<?php

namespace Modules\NC\Http\Livewire\Dashboard;

use App\Models\UserGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\NC\Entities\NCClassification;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{
    use WithPagination;

    public $start_date;
    public $end_date;
    public $sectors = [];
    public $tab = 'created_by_me';
    public $logged_roles = [];
    public $users_has_roles = [];

    protected $listeners = [
        'refreshChildren' => 'refreshMe',
        'refreshParent' => '$refresh'
    ];

    public function mount()
    {
        $this->start_date = now()->subDays(30);
        $this->end_date = date('Y-m-d');
        $this->sectors = UserGroup::pluck('id');
        $this->logged_roles = Auth::user()->roles->whereNotIn('name', ['coordenador', 'gerente']);
        $this->users_has_roles = User::role($this->logged_roles)->pluck('id');
    }

    public function refreshMe($start_date, $end_date, $selected_sectors)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->sectors = $selected_sectors;

        $this->render();
    }

    public function export()
    {

    }


    public function render()
    {
        return match ($this->tab) {
            'created_by_me' => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::where('source_user_id', Auth::user()->id)->whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at')->paginate(10)]),
            'created_by_group' => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::whereHas('sourceUser', function ($q) {
                $q->whereIn('users.id', $this->users_has_roles);
            })->whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at')->paginate(10)]),
            'group_nc' => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::whereHas('targetUsers', function ($q) {
                $q->whereIn('users.id', $this->users_has_roles);
            })->whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at')->paginate(10)]),
            default => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at')->paginate(10)]),
        };

    }
}
