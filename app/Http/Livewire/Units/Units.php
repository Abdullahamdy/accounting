<?php

namespace App\Http\Livewire\Units;

use App\Models\Unit;
use Livewire\Component;
use Livewire\WithPagination;

class Units extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshUnitsList' => 'ActionRefreshUnitsList'
    ];

    function ActionRefreshUnitsList()
    {

    }

    public function render()
    {
        return view('livewire.units.units', [
            'units' => Unit::paginate(5)
        ]);
    }
}
