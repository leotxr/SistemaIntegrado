<?php

namespace Modules\HelpDesk\Http\Livewire\Guest\ExtraService;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\HelpDesk\Entities\ExtraService;

class FormCreate extends Component
{
    public ExtraService $saving;

    protected $rules = [
        'saving.sector' => 'required|string',
        'saving.item' => 'max:50',
        'saving.title' => 'required|string',
        'saving.description' => 'required|string',
    ];

    public function mount()
    {
        $this->saving = new ExtraService();
    }

    public function checkAndSave()
    {
        $this->validate();
        $this->saving->requester_id = Auth::user()->id;
        $this->saving->status_id = 1;
        return $this->saving->save() ? true : throw new \Exception('Ocorreu um erro ao salvar a solicitação. Tente novamente.');
    }

    public function save()
    {

        try {
            $this->checkAndSave();
            return redirect()->to('/helpdesk/chamados')->with('success', 'Solicitação enviada com sucesso!');
        } catch (\Exception $e) {
            return $this->dispatchBrowserEvent('notify', ['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('helpdesk::livewire.guest.extra-service.form-create');
    }
}
