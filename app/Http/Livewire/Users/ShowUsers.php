<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;
        
    public function render()
    {
        return view('livewire.users.show-users', [
            'users' => User::all()->paginate(10)
        ]);
    }
}
