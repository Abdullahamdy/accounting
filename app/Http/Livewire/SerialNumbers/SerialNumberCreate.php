<?php

namespace App\Http\Livewire\SerialNumbers;

use App\Models\Item;
use App\Models\SerialNumber;
use Livewire\Component;

class SerialNumberCreate extends Component
{
    public $serial_number;

    public function store()
    {
        $data = $this->validate([
            'serial_number.title' => 'required',
            'serial_number.serial' => 'required|unique:serial_numbers,serial',
            'serial_number.item_id' => 'required|int|exists:items,id',
            'serial_number.status' => 'in:0,1',
        ]);

        $serial_number = SerialNumber::create($data['serial_number']);

        $this->emit('refreshSerialNumbersList');
        $this->dispatchBrowserEvent('close-modal');
        $this->serial_number = [];
    }

    public function render()
    {
        return view('livewire.serial-numbers.serial-number-create', [
            'items' => Item::all()
        ]);
    }
}
