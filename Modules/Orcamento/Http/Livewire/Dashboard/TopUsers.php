<?php

namespace Modules\Orcamento\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\User;
use Modules\Orcamento\Entities\Budget;

class TopUsers extends Component
{
    public $users = [];
    public $values = [];
    public $user_names = [];

    public function mount()
    {
        //$this->users = User::permission('criar orcamento')->get();

        foreach(User::permission('criar orcamento')->get() as $user)
        {
            //if($user->relBudgets->count() > 0) $this->users[] = $user;
            
            //$this->values[] = Budget::whereBelongsTo($user, 'User')->count();
            if($user->relBudgets->count() > 0) 
            {
                $this->values[] = User::find($user->id)->relBudgets->count();
                $this->user_names[] = $user->name; 
                $this->users[] = $user;
            }

        }

        
       
    }

    public function render()
    {
        return view('orcamento::livewire.dashboard.top-users');
    }
}
