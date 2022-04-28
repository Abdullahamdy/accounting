<?php

namespace App\Http\Livewire\SerialNumbers;

use App\Models\Item;
use App\Models\SerialNumber;
use Livewire\Component;

class SerialNumberEdit extends Component
{
    public $serial_number;
    public function mount($serial_number_id)
    {
        $this->serial_number = SerialNumber::find($serial_number_id);
        $this->serial_number = $this->serial_number->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'serial_number.title' => 'required',
            'serial_number.serial' => 'required|unique:serial_numbers,serial,' . $this->serial_number['id'],
            'serial_number.item_id' => 'required|int|exists:items,id',
            'serial_number.status' => 'in:0,1',
        ]);

        $serial_number_update = SerialNumber::find($this->serial_number['id']);
        $serial_number_update->update($data['serial_number']);

        $this->emit('refreshSerialNumbersList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.serial-numbers.serial-number-edit', [
            'items' => Item::all()
        ]);
    }
}
