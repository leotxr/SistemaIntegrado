<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Collection;
use Modules\Orcamento\Entities\Budget;

class TopUsers extends Component
{
    public $users;
    public $values = [];
    public $user_names = [];
    public $submonth = 1;

    protected $listeners = [
        'change-submonth' => 'fetchData'
    ];

    public function mount()
    {
        $this->users = User::permission('criar orcamento')->get();

        foreach ($this->users as $user) {
            if ($user->relBudgets->count() > 0) {
                $this->values[] = Budget::whereBelongsTo($user, 'User')->whereBetween('budget_date', [today()->subMonths($this->submonth), today()->subMonths(0)])->count();
                $this->user_names[] = $user->name;
            }
        }
    }

    public function fetchData($submonth)
    {
        $this->submonth = $submonth;

        foreach ($this->users as $user) {
            if ($user->relBudgets->count() > 0) {
                $values[] = Budget::whereBelongsTo($user, 'User')->whereBetween('budget_date', [today()->subMonths($this->submonth), today()->subMonths(0)])->count();
                $user_names[] = $user->name;
            }
        }
        $this->values = array_replace($this->values, $values);
        $this->user_names = array_replace($this->user_names, $user_names);
        $this->emit('refreshChart', ['seriesData' => $this->values, 'labelData' => $this->user_names]);
    }


    public function render()
    {
       
        
        return view('orcamento::livewire.dashboard.top-users');
    }
}
