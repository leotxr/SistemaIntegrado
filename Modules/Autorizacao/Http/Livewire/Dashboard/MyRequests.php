<?php

namespace Modules\Autorizacao\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Autorizacao\Entities\Protocol;
use Modules\Autorizacao\Entities\Exam;
use Modules\Autorizacao\Entities\Photo;
use Modules\Autorizacao\Entities\ExamStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class MyRequests extends Component
{
    use WithPagination;

    public $activeStatus = [];
    public $sortField = 'exams.exam_date';
    public $sortDirection = 'desc';
    public $search = '';
    public $initial_date;
    public $final_date;
    public $modalFilters = false;
    public $statuses;
    public $editing;
    public $modalExam = false;
    public $modalDelete = false;
    public $isDisabled;
    public $editing_protocol;
    public $users;
    public $selectedUsers = [];
    public $modalObservacao = false;

    protected $rules = [
        'editing.*.exam_status_id' => 'required',
        'editing.*.exam_obs' => 'max:200',
        'editing_protocol.recebido' => 'boolean',
    ];


    public function mount()
    {
        $this->statuses = ExamStatus::all();
        $this->users = User::permission('criar autorizacao')->get();

        foreach ($this->statuses as $status) {
            $this->activeStatus[] = $status->id;
        }

        foreach ($this->users as $user) {
            $this->selectedUsers[] = $user->id;
        }
    }
    public function searchFilters()
    {
        $this->modalFilters = true;
    }

    public function sortBy($field)
    {

        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc'
            : 'desc';

        $this->sortField = $field;
    }

    public function openEdit($protocol)
    {
        $this->modalExam = true;
        $this->editing = Exam::where('protocol_id', $protocol)->get();
        $this->editing_protocol = Protocol::find($protocol);
        
        $this->editing_protocol->recebido == 1 ? $this->isDisabled = true : $this->isDisabled = false;

    }

    public function confirmDelete(Protocol $protocol)
    {
        $this->modalDelete = true;
    }

    public function delete(Protocol $protocol)
    {
        $delete_exam = Exam::where('protocol_id', $protocol->id)->delete();
        $photos = Photo::where('protocol_id', $protocol->id)->get();
        foreach($photos as $photo)
        {
            $delete_path = Storage::deleteDirectory(public_path($photo->url));
            if($delete_path)
            $photo->delete();
        }
        
        if ($delete_exam)
            $protocol->delete();

        return redirect()->route('autorizacao.index');
    }

    public function showObservacao(Protocol $protocol)
    {
        $this->modalObservacao = true;
        $this->editing_protocol = $protocol;
    }

    public function save()
    {
        //$this->validate();
        
        foreach ($this->editing as $exam) {
            $exam->save();
        }

        if($this->editing_protocol)
        {
            $saving_protocol = $this->editing_protocol;
            $saving_protocol->save(); 
        }


        $this->modalExam = false;
        
    }

    public function render()
    {
        if(Auth::user()->can('editar autorizacao'))
        {
            return view('autorizacao::livewire.dashboard.my-requests', ['selectedStatus' => Protocol::search($this->sortField, $this->search)->join('exams', 'exams.protocol_id', '=', 'protocols.id')
            ->orderBy($this->sortField, $this->sortDirection)
            ->whereIn('protocols.user_id', $this->selectedUsers)
            ->whereBetween('exams.created_at', [$this->initial_date, $this->final_date])
            ->whereIn('exams.exam_status_id', $this->activeStatus)
            ->paginate(10)]);
        }else
        {
        return view('autorizacao::livewire.dashboard.my-requests', ['selectedStatus' => Protocol::search($this->sortField, $this->search)->join('exams', 'exams.protocol_id', '=', 'protocols.id')
            ->orderBy($this->sortField, $this->sortDirection)
            ->where('protocols.user_id', Auth::user()->id)
            ->whereBetween('exams.created_at', [$this->initial_date, $this->final_date])
            ->whereIn('exams.exam_status_id', $this->activeStatus)
            ->paginate(10)]);
        }
    }
}
