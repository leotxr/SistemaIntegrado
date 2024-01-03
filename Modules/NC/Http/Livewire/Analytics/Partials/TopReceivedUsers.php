<?php

namespace Modules\NC\Http\Livewire\Analytics\Partials;

use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\User;

class TopReceivedUsers extends Component
{
    public $users;
    public $user_count;
    public $start_date;
    public $end_date;

    protected $listeners = [
        'echo:nc-analytics,NonConformityCreated' => 'refreshMe',
        'refreshChildren' => 'refreshMe'
    ];

    public function getData($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->users = User::all();
        $user_count = collect();

        foreach ($this->users as $user) {
            if ($user->nonConformities->count() > 0) {
                $user_count[] = collect(['name' => $user->name . ' ' . $user->lastname, 'value' => $user->nonConformities->count()]);
            }
        }
        return $user_count;
    }

    public function mount($start_date, $end_date)
    {
        $this->user_count = $this->getData($start_date, $end_date);
    }

    public function refreshMe()
    {
        $this->user_count = $this->getData($this->start_date, $this->end_date);
    }

    public function render()
    {
        return view('nc::livewire.analytics.partials.top-received-users');
    }
}
