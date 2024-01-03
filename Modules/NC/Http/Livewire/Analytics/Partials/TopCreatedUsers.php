<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class TopCreatedUsers extends Component
{
    public $users;
    public Collection $user_count;

    public function mount()
    {
        $this->users = User::all();
        $this->user_count = collect();

        foreach ($this->users as $user) {
            if($user->sourceUser->count() > 0)
            {
                $this->user_count[] = collect(['name' => $user->name, 'value' => $user->sourceUser->count()]);;
            }
        }

    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.top-created-users');
    }
}
