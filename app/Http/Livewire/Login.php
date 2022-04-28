<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Login extends Component
{
    public $user, $state;

    public function mount()
    {

    }

    public function login()
    {
        $user = $this->validate([
            'user.email' => 'required|email|exists:' . User::class . ',email',
            'user.password' => 'required|min:6',
        ]);

        if (auth()->attempt($user['user'])) {
            return $this->redirect(route('home'));
        } else {
            $this->addError("user.password", "كلمة المرور خطأ");
        }
    }

    public function render()
    {
        return view('livewire.login')->layout('layouts.guest');
    }
}
