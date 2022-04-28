<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserShow extends Component
{
    public $user;
    protected $listeners = [
        'refreshUserShow' => 'ActionRefreshUserShow'
    ];

    public function ActionRefreshUserShow()
    {

    }

    public function mount($user_id)
    {
        if(auth()->user()->hasRole('Admin')) {
            $this->user = User::where('id', $user_id)->firstOrFail();
        } else {
            $this->user = User::where('id', auth()->id())->where('id', $user_id)->firstOrFail();
        }
    }

    public function render()
    {
        return view('livewire.users.user-show');
    }
}
