<?php

namespace App\Http\Livewire\SerialNumbers;

use App\Models\SerialNumber;
use Livewire\Component;
use Livewire\WithPagination;

class SerialNumbers extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshSerialNumbersList' => 'ActionRefreshSerialNumbersList'
    ];

    function ActionRefreshSerialNumbersList()
    {

    }

    public function render()
    {
        $serial_numbers = SerialNumber::paginate(5);
        return view('livewire.serial-numbers.serial-numbers', [
            'serial_numbers' => $serial_numbers
        ]);
    }
}
