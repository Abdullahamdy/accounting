<?php

namespace App\Http\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;

class UnitDelete extends Component
{
    public $unit;

    public function mount($unit_id)
    {
        $this->unit = Unit::find($unit_id);
    }

    public function delete()
    {
        $unit = Unit::find($this->unit['id']);
        $unit->delete();

        $this->emit('refreshUnitsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.units.unit-delete');
    }
}
