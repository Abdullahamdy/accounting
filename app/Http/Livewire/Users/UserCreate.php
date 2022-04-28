<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public $user;
    public $role_id;

    public function mount()
    {
        if (request('role_id')) {
            $this->role_id = request('role_id');
        }
        $this->user['role_id'] = $this->role_id;
    }

    public function store()
    {
        $data = $this->validate([
            'user.name' => 'required',
            'user.email' => 'nullable|email|unique:users,email',
            'user.mobile' => 'nullable|string|unique:users,mobile',
            'user.address' => 'nullable',
            'user.balance' => 'nullable',
            'user.salary' => 'nullable',
            'user.job' => 'nullable',
            'user.section' => 'nullable',
            'user.id_number' => 'nullable',
            'user.bank_name' => 'nullable',
            'user.bank_account_number' => 'nullable',
//            'user.password' => 'nullable|min:6',
            'user.role_id' => 'nullable',
            'user.role_id.*' => 'nullable|int|exists:roles,id',
        ]);

        $data['user']['password'] = Hash::make("12345678");
        if (!$data['user']['role_id']) {
            $data['user']['role_id'] = 3;
        }
        $user = User::create($data['user']);
        $user->syncRoles($data['user']['role_id']);

        $this->emit('refreshUsersList');
        $this->dispatchBrowserEvent('close-modal');
        $this->user = [];
        $this->user['role_id'] = $this->role_id;
        return $this->redirect(url('/users?role_id='.$this->role_id));
    }

    public function render()
    {
        return view('livewire.users.user-create', [
            'roles' => Role::all(),
        ]);
    }
}
