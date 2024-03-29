<?php

namespace Modules\Orcamento\Http\Livewire\Budget;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Orcamento\Entities\Budget;
use Modules\Orcamento\Entities\BudgetStatus;
use App\Events\BudgetCreated;
use App\Events\TicketUpdated;
use Modules\Orcamento\Entities\BudgetType;

class ShowBudgets extends Component
{
    use WithPagination;

    public $modalBudget = false;
    public $modalDetails = false;
    public $modalFilters = false;
    public Budget $showing;
    public $initial_date;
    public $final_date;
    public $selectedStatus = [1];
    public $selectedType = 3;
    public $search = '';
    public $logged_roles;
    public $users_has_roles;

    protected $listeners = [
        'close-modal' => 'closeModalBudget',
        'echo:budget-dashboard,BudgetCreated' => '$refresh',
        'budget-updated' => '$refresh'
    ];

    public function mount()
    {
        $this->initial_date = today()->subDays(2)->format('Y-m-d');
        $this->final_date = today()->format('Y-m-d');
        $this->logged_roles = Auth::user()->roles->whereNotIn('name', ['coordenador', 'gerente']);
        $this->users_has_roles = User::role($this->logged_roles)->pluck('id');
    }

    public function openModalBudget()
    {
        $this->modalBudget = true;
    }

    public function openModalDetails(Budget $orcamento)
    {
        $this->showing = $orcamento;
        $this->modalDetails = true;
    }

    public function closeModalBudget()
    {
        $this->modalBudget = false;
        $this->modalDetails = false;
        $this->render();
    }

    public function selectType($type_id)
    {
        $this->selectedType = $type_id;
    }

    public function render()
    {
        $raw_budgets = Budget::whereHas('User', function ($q) {
            Auth::user()->can('excluir orcamento') ? $q->whereIn('users.id', User::all()->pluck('id')) :
                $q->whereIn('users.id', $this->users_has_roles);
        })->whereBetween('budget_date', [$this->initial_date, $this->final_date]);

        return view('orcamento::livewire.budget.show-budgets', [
            'orcamentos' => $raw_budgets->search('patient_name', $this->search)->whereIn('budget_status_id', $this->selectedStatus)->where('budget_type_id', $this->selectedType)->paginate(10),
            'statuses' => BudgetStatus::whereNot('type_id', 0)->orderBy('id', 'DESC')->get(),
            'types' => BudgetType::whereNotIn('id', [1])->get(),
            'budget_tile' => Budget::whereHas('User', function ($q) {
                Auth::user()->can('excluir orcamento') ? $q->whereIn('users.id', User::all()->pluck('id')) :
                    $q->whereIn('users.id', $this->users_has_roles);
            })->whereBetween('budget_date', [$this->initial_date, $this->final_date])->get()
        ]);
    }
}
