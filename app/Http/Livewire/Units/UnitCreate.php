<?php

namespace App\Http\Livewire\Units;

use App\Models\Item;
use App\Models\Unit;
use Livewire\Component;

class UnitCreate extends Component
{
    public $unit,$item_id;

    function mount($item_id = 0){
        $this->unit['item_id'] = $item_id;

        $this->item_id = $this->unit['item_id'];
        
    }

    public function store()
    {
       
        $data = $this->validate([
            'unit.name' => 'required',
            'unit.pieces' => 'nullable',
            'unit.measruing_unit'=>'required',
            'unit.selling_price'=>'required',
            'unit.purchasing_price'=>'required',
            'unit.item_id'=>'required',
        ]);


        $unit = Unit::create($data['unit']);

        $this->emit('refreshUnitsList');
        $this->dispatchBrowserEvent('close-modal');
        $this->unit = [];   
         $this->unit['item_id'] = $this->item_id;
    }

    public function render()
    {
        return view('livewire.units.unit-create',[
            'items'=>Item::all()
        ]);
    }
}
