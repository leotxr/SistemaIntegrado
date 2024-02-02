<?php

namespace Modules\NC\Http\Livewire\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\UserGroup;
use Spatie\Permission\Models\Role;

class DashboardFilter extends Component
{
    public $start_date;
    public $end_date;
    public $modal_filters = false;
    public $selectAllUsers = false;
    public $selected_users = [];
    public $selected_target_users = [];

    public $groups;
    public $user_type;

    public $in_use = false;

    public $logged_roles = [];

    protected $rules = [
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    public function mount()
    {
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-t');

        $this->groups = UserGroup::all();

        if (Auth::user()->can(['excluir ncs', 'ver historico de ncs']))
            $this->logged_roles = Role::all()->pluck('name');
        else
            $this->logged_roles = Auth::user()->roles->whereNotIn('name', ['coordenador', 'gerente']);

        //$this->selected_users = User::role($this->logged_roles)->pluck('id');
    }

    public function openModal($key)
    {
        $this->user_type = $key;
        $this->modal_filters = true;


    }

    public function updatedselectAllUsers($value)
    {
        if ($value)
        {
            $this->user_type == 'created' ? $this->selected_users = User::role($this->logged_roles)->pluck('id') : $this->selected_target_users = User::role($this->logged_roles)->pluck('id');
        }
        else
        {
            $this->user_type == 'created' ? $this->selected_users = [] : $this->selected_target_users = [];
        }

    }

    public function refreshChildren()
    {
        $this->in_use = true;
        $this->emitUp('refreshChildren', $this->start_date, $this->end_date, $this->selected_users, $this->selected_target_users);
    }

    public function resetFilters()
    {
        $this->mount();
        $this->emitUp('resetChildren');
        $this->in_use = false;
    }

    public function render()
    {
        return view('nc::livewire.utils.dashboard-filter',
            ['users' => User::role($this->logged_roles)->orderBy('name', 'ASC')->get(),
                'target_users' => User::role($this->logged_roles)->orderBy('name', 'ASC')->get()]);
    }
}
