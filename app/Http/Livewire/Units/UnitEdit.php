<?php

namespace App\Http\Livewire\Units;

use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;

class UnitEdit extends Component
{
    public $unit;
    public function mount($unit_id)
    {
        $this->unit = Unit::find($unit_id);
        $this->unit = $this->unit->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'unit.name' => 'required',
            'unit.pieces' => 'nullable',
            'unit.measruing_unit'=>'required',
            'unit.selling_price'=>'required',
            'unit.purchasing_price'=>'required',
            'unit.item_id'=>'required',
        ]);

        $unit_update = Unit::find($this->unit['id']);
        $unit_update->update($data['unit']);

        $this->emit('refreshUnitsList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.units.unit-edit',[
            'items'=>Item::all()
        ]);
    }
}
