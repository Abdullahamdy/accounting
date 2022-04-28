<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    protected $listeners = ['refreshProfile' => 'refreshProfileFunction'];

    public function refreshProfileFunction(){

    }

    public function render()
    {
        return view('livewire.profile');
    }
}
