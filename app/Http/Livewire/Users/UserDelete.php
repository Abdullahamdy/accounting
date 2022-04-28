<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class UserDelete extends Component
{
    public $user;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
    }

    public function delete()
    {
        $user = User::find($this->user['id']);
        $user->delete();

        $this->emit('refreshUsersList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.users.user-delete');
    }
}
