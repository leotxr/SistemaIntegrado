<?php

namespace App\Http\Livewire\Devices;

use Livewire\Component;
use App\Models\Device;

class ShowDevices extends Component
{
    public $devices;

    public function mount()
    {
        $output = NULL;
        $result = NULL;
        $this->devices = Device::all();

        foreach($this->devices as $device)
        {
            PHP_OS == "Linux" ? exec("ping -c 1 -W 1 " . $device->ip_address, $output, $result) : exec("ping -n 1 -w 1 " . $device->ip_address, $output, $result);
            $result == 0 ? [$device->active = 1, $device->last_response = now()->format('Y-m-d H:i:s')] : $device->active = 0;
        }
    }

    public function render()
    {
        return view('livewire.devices.show-devices');
    }
}
