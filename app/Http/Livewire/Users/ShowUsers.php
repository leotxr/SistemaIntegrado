<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    public $search_user = '';
    public $sortField = 'name';
        
    public function render()
    {
        return view('livewire.users.show-users', [
            'users' => User::search($this->sortField, $this->search_user)->paginate(10)
        ]);
    }
}
