<?php

namespace Modules\NC\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\User;
use Modules\NC\Entities\NonConformity;
use Maatwebsite\Excel\Facades\Excel;
use Modules\NC\Exports\Reports\ReceivedByUserExport;

use Illuminate\Support\Facades\DB;

class ReceivedByEmployee extends Component
{
    public $start_date;
    public $end_date;
    public $modalUsers = false;
    public $users;
    public $selectedUsers = [];
    public $userNames = [];
    public $countUsers = [];

    private function getUsers()
    {
        $users = User::select('id', 'name', 'lastname', 'username')->whereNull('deleted_at')->where('id', '!=', 0)->get();

        $this->users = $users;
    }

    public function setUsers()
    {
        $this->modalUsers = false;
        $this->userNames = User::select('name', 'lastname', 'id')->whereIn('id', $this->selectedUsers)->get();
        
    }

    public function getUserCount($userId, $startDate, $endDate)
    {
        $ncUser = DB::table('non_conformities AS nc')
                    ->join('non_conformity_user_sector AS ncus', 'ncus.non_conformity_id', '=', 'nc.id')
                    ->join('users AS us', 'us.id', '=', 'ncus.user_id')
                    ->where('us.id', $userId)
                    ->whereBetween('nc.n_c_date', [$startDate, $endDate])
                    ->count();

        $userReport = DB::table('non_conformities AS nc')
                    ->where('source_user_id', $userId)
                    ->whereBetween('nc.n_c_date', [$startDate, $endDate])
                    ->count();

        $userData = User::find($userId);

        $userNCData['nome'] = $userData->name . " " . $userData->lastname;
        $userNCData['recebidas'] = $ncUser;
        $userNCData['reportadas'] = $userReport;

        return $userNCData;
    }

    public function setRetornoUsers()
    {
        $users = $this->selectedUsers;

        foreach($users as $user)
        {
            $userCount = $this->getUserCount($user, $this->start_date, $this->end_date);
            $count[] = [
                'id' => $user,
                'nome' => $userCount['nome'],
                'recebidas' => $userCount['recebidas'],
                'reportadas' => $userCount['reportadas']
            ];
        }

        return $count;
    }

    public function search()
    {
        $this->countUsers = $this->setRetornoUsers();
    }

    public function export()
    {
        $range = [
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'users' => $this->selectedUsers
        ];
        return Excel::download(new ReceivedByUserExport($range), 'nao-conformidades-funcionario-' . '-' . $this->start_date . '-' . $this->end_date . '.xlsx');
    }

    public function render()
    {
        $this->getUsers();
        return view('nc::livewire.reports.received-by-employee');
    }
}
