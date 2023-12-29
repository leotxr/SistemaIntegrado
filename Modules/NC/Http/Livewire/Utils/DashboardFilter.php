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

    public $logged_roles = [];

    protected $rules = [
        'start_date' => 'required',
        'end_date' => 'required'
    ];
    public function mount()
    {
        $this->start_date = date('Y-m-01');
        $this->end_date = date('Y-m-t');

        if (Auth::user()->can(['excluir ncs', 'ver historico de ncs']))
            $this->logged_roles = Role::all()->pluck('name');
        else
            $this->logged_roles = Auth::user()->roles->whereNotIn('name', ['coordenador', 'gerente']);

        //$this->selected_users = User::role($this->logged_roles)->pluck('id');
    }

    public function updatedselectAllUsers($value)
    {
        if($value)
            $this->selected_users = User::role($this->logged_roles)->pluck('id');
        else
            $this->selected_users = [];
    }

    public function refreshChildren()
    {
        $this->emitUp('refreshChildren', $this->start_date, $this->end_date, $this->selected_users);
    }

    public function render()
    {
        return view('nc::livewire.utils.dashboard-filter', ['users' => User::role($this->logged_roles)->get()]);
    }
}
