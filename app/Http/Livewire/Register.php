<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $user = [] ,$success;

    public function store()
    {
        $user = $this->validate([
            'user.email' => 'required|email|unique:' . User::class . ',email',
            'user.mobile' => 'required|unique:' . User::class . ',mobile',
            'user.password' => 'required|min:6|confirmed',
            'user.approved' => 'required',
        ]);

        $user['user']['password'] = Hash::make($user['user']['password']);
        $user = User::create($user['user']);

        $user->syncRoles('2');

        auth()->login($user);

        $this->reset();
        return $this->redirect(route('profile'));

    }

    public function render()
    {
        return view('livewire.register')->layout('layouts.guest');
    }
}
