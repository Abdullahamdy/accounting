<?php

namespace App\Http\Livewire\SerialNumbers;

use App\Models\SerialNumber;
use Livewire\Component;

class SerialNumberShow extends Component
{
    public $serial_number;

    protected $listeners = [
        'refreshSerialNumberShow' => 'ActionRefreshSerialNumberShow'
    ];

    public function ActionRefreshSerialNumberShow()
    {

    }

    public function mount($serial_number_id)
    {
        $this->serial_number = SerialNumber::where('id', $serial_number_id)->first();
    }

    public function render()
    {
        return view('livewire.serial-numbers.serial-number-show');
    }
}
