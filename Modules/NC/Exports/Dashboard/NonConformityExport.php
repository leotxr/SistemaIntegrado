<?php

namespace Modules\NC\Exports\Dashboard;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\NC\Entities\NonConformity;

class NonConformityExport implements FromView
{
    use Exportable;

    public $start;
    public $end;
    public $type;
    public $users;


    public function __construct($range)
    {
        $this->start = $range['start_date'];
        $this->end = $range['end_date'];
        $this->type = $range['type'];
        $this->users = $range['users'];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {

        return match ($this->type) {
            'created_by_me' => view('nc::livewire.utils.table-export', ['ncs' => NonConformity::where('source_user_id', Auth::user()->id)->whereBetween('n_c_date', [$this->start, $this->end])->orderBy('created_at')->get()]),

            'created_by_group' => view('nc::livewire.utils.table-export', ['ncs' => NonConformity::whereHas('sourceUser', function ($q) {
                $q->whereIn('users.id', $this->users);
            })->whereBetween('n_c_date', [$this->start, $this->end])->orderBy('created_at')->get()]),

            'group_nc' => view('nc::livewire.utils.table-export', ['ncs' => NonConformity::whereHas('targetUsers', function ($q) {
                $q->whereIn('users.id', $this->users);
            })->whereBetween('n_c_date', [$this->start, $this->end])->orderBy('created_at')->get()]),

            default => view('nc::livewire.utils.table-export', ['ncs' => NonConformity::whereBetween('n_c_date', [$this->start, $this->end])->orderBy('created_at')->get()]),
        };
    }
}
