<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Logout extends Component
{

    public function logout(){

        if(auth()->check()){
            auth()->logout();
        }

        return $this->redirect(route('login'));
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
