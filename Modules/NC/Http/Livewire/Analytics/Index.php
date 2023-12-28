<?php

namespace Modules\NC\Http\Livewire\Analytics;

use App\Models\UserGroup;
use Livewire\Component;
use Modules\NC\Entities\NonConformity;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Index extends Component
{
    public $ncs;
    public $ncs2;

    public $ncs3;
    public $ncs4;

    public $ncs5;
    public $logged_roles = [];
    public $users_has_roles = [];

    public function mount()
    {
        //MOSTRA DO GRUPO DO USUARIO LOGADO
        $this->ncs = User::all();

        $this->ncs2 = UserGroup::all();

        $this->logged_roles = Auth::user()->roles->whereNotIn('name', ['coordenador', 'gerente']);
        $this->users_has_roles = User::role($this->logged_roles)->pluck('id');

        //dd($logged_roles);

        //busca pelos usuários responsaveis
        $this->ncs3 = NonConformity::whereHas('targetUsers', function($q){
            $q->whereIn('users.id', $this->users_has_roles);
        })->get();

        //busca pelos usuários que identificaram
        $this->ncs4 = NonConformity::whereHas('sourceUser', function($q){
           $q->whereIn('users.id', $this->users_has_roles);
        })->get();

        //busca pelo usuario logado
        $this->ncs5 = NonConformity::where('source_user_id', Auth::user()->id)->get();





        /*
        $this->ncs3 = NonConformity::whereHas('targetSectors', function($q){
           $q->where('user_groups.id', 5);
        })->get();
        */



    }

    public function render()
    {
        return view('nc::livewire.analytics.index');
    }
}
