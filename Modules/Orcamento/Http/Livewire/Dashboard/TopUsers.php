<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Collection;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;

class TopUsers extends Component
{
    public $users;
    public $values = [];
    public $user_names = [];
    public $submonth;

    protected $listeners = [
        'refreshChildren' => 'refreshUserCount'
    ];

    public function refreshUserCount($submonth)
    {
        $this->submonth = $submonth;

        foreach ($this->users as $user) {
            if ($user->budgets->count() > 0) {
                $values[] = Budget::whereBelongsTo($user, 'User')->whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])->count();
                $user_names[] = $user->name;
            }
        }
        $values = array_replace($this->values, $values);
        $user_names = array_replace($this->user_names, $user_names);
        $this->emit('refreshUserChart', ['seriesUserData' => $values]);
    }

    public function mount($submonth)
    {
        $this->submonth = $submonth;
        $this->users = User::permission('criar orcamento')->get();

        foreach ($this->users as $user) {
            if ($user->budgets->count() > 0) {
                $this->values[] = Budget::whereBelongsTo($user, 'User')->whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])->count();
                $this->user_names[] = $user->name;
            }
        }
    }

    


    public function render()
    {
       
        
        return view('orcamento::livewire.dashboard.top-users', 
        ['statuses' => BudgetStatus::whereIn('type_id', [1, 2])->get(),
        'orcamentos' => Budget::whereBetween('budget_date', [today()->subDays($this->submonth), today()->subDays(0)])
        ->whereIn('initial_status_id', [1, 2, 3])
            ->get()]);
    }
}
