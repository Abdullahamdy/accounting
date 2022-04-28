<?php

namespace App\Http\Livewire\SerialNumbers;

use App\Models\SerialNumber;
use Livewire\Component;

class SerialNumberDelete extends Component
{
    public $serial_number;

    public function mount($serial_number_id)
    {
        $this->serial_number = SerialNumber::find($serial_number_id);
    }

    public function delete()
    {
        $serial_number = SerialNumber::find($this->serial_number['id']);
        $serial_number->delete();

        $this->emit('refreshSerialNumbersList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.serial-numbers.serial-number-delete');
    }
}
