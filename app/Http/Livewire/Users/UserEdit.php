<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public $user;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
        $this->user['role_id'] = $this->user->roles->pluck('id');
        $this->user = $this->user->toArray();
    }

    public function update()
    {
        $data = $this->validate([
            'user.name' => 'required',
            'user.email' => 'nullable|email|unique:users,email,' . $this->user['id'],
            'user.mobile' => 'nullable|string|unique:users,mobile,' . $this->user['id'],
            'user.address' => 'nullable',
            'user.balance' => 'nullable',
            'user.salary' => 'nullable',
            'user.job' => 'nullable',
            'user.section' => 'nullable',
            'user.id_number' => 'nullable',
            'user.bank_name' => 'nullable',
            'user.bank_account_number' => 'nullable',
            'user.password' => 'nullable|min:6',
            'user.role_id' => 'nullable|array',
            'user.role_id.*' => 'nullable|int|exists:roles,id',
        ]);

        if (empty($data['user']['password']) or $data['user']['password'] == "") {
            unset($data['user']['password']);
        } else {
            $data['user']['password'] = Hash::make($data['user']['password']);
        }

        $user_update = User::find($this->user['id']);

        $user_update->syncRoles($data['user']['role_id']);
        $user_update->update($data['user']);

        $this->emit('refreshUsersList');
        $this->emit('refreshUserShow');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.users.user-edit', [
            'roles' => Role::all(),
        ]);
    }
}
