<?php

namespace Modules\NC\Exports\Reports;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\NC\Entities\NonConformity;
use Modules\NC\Http\Livewire\Reports\ReceivedByEmployee;

class ReceivedByUserExport implements FromView
{
    use Exportable;

    public $start_date;
    public $end_date;
    public $selectedUsers;
    private $reportController;


    public function __construct($range)
    {
        $this->start_date = $range['start_date'];
        $this->end_date = $range['end_date'];
        $this->selectedUsers = $range['users'];

        $this->reportController = new ReceivedByEmployee();
    }

    private function setUsers()
    {
        $users = $this->selectedUsers;

        foreach($users as $user)
        {
            $userCount = $this->reportController->getUserCount($user, $this->start_date, $this->end_date);
            $count[] = [
                'id' => $user,
                'nome' => $userCount['nome'],
                'recebidas' => $userCount['recebidas'],
                'reportadas' => $userCount['reportadas']
            ];
        }

        return $count;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $retorno = $this->setUsers();
        return view('nc::reports.tables.nc_users_table', ['countUsers' => $retorno]);
    }
}
