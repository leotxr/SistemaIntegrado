<?php

namespace Modules\NC\Http\Livewire\Dashboard;

use App\Models\UserGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Gestao\Exports\Laudo\ExamsExport;
use Modules\NC\Entities\NCClassification;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Modules\NC\Exports\Dashboard\NonConformityExport;

class Index extends Component
{
    use WithPagination;

    public $start_date;
    public $end_date;
    public $tab = 'created_by_me';
    public $logged_roles = [];
    public $users_has_roles = [];
    public $selected_users = [];

    protected $listeners = [
        'refreshChildren' => 'refreshMe',
        'refreshParent' => '$refresh',
        'resetChildren' => 'mount'
    ];

    public function mount()
    {
        $this->start_date = date('Y-m-01 00:00:00');
        $this->end_date = date('Y-m-t 23:59:59');
        $this->logged_roles = Auth::user()->roles->whereNotIn('name', ['coordenador', 'gerente']);
        $this->users_has_roles = User::role($this->logged_roles)->pluck('id');
    }

    public function refreshMe($start_date, $end_date, $selected_users)
    {
        $this->selected_users = $selected_users;

        $this->start_date = $start_date;
        $this->end_date = $end_date;
        if (count($this->selected_users) > 0)
            $this->users_has_roles = $this->selected_users;

        $this->render();
    }

    public function export()
    {
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'type' => $this->tab,
            'users' => $this->users_has_roles
        ];
        return Excel::download(new NonConformityExport($range), 'nao-conformidades-' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }


    public function render()
    {
        return match ($this->tab) {
            'created_by_me' => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::where('source_user_id', Auth::user()->id)
                ->whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at', 'desc')->paginate(10)]),

            'created_by_group' => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::whereHas('sourceUser', function ($q) {
                $q->whereIn('users.id', $this->users_has_roles);
            })->whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at', 'desc')->paginate(10)]),

            'group_nc' => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::whereHas('targetUsers', function ($q) {
                $q->whereIn('users.id', $this->users_has_roles);
            })->whereBetween('n_c_date', [$this->start_date, $this->end_date])->orderBy('created_at', 'desc')->paginate(10)]),

            default => view('nc::livewire.dashboard.index', ['ncs' => NonConformity::with('targetUsers')->with('sourceUser')
                ->whereHas('targetUsers', function ($q) {
                    count($this->selected_users) > 0 ? $q->whereIn('users.id', $this->users_has_roles) : $q->whereNotNull('users.id');
                    $q->whereBetween('n_c_date', [$this->start_date, $this->end_date]);
                })->orWhereHas('sourceUser', function ($q) {
                    count($this->selected_users) > 0 ? $q->whereIn('users.id', $this->users_has_roles) : $q->whereNotNull('users.id');
                    $q->whereBetween('n_c_date', [$this->start_date, $this->end_date]);
                })->orderBy('created_at', 'desc')->paginate(10)]),
        };

    }
}
