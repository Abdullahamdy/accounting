<?php

namespace App\Http\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;

class UnitShow extends Component
{
    public $unit;
    protected $listeners = [
        'refreshUnitShow' => 'ActionRefreshUnitShow'
    ];

    public function ActionRefreshUnitShow()
    {

    }

    public function mount($unit_id)
    {
        $this->unit = Unit::where('id', $unit_id)->first();
    }

    public function render()
    {
        return view('livewire.units.unit-show');
    }
}
