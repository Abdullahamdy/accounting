<?php

namespace App\Http\Livewire\Users\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $role = ['permissions' => []];
    public $permissions, $user_permissions;

    public function mount()
    {
        $this->permissions = Permission::all();

    }
    public function store()
    {
        $data = $this->validate([
            'role.name' => 'required|string',
            'user_permissions' => 'array',
        ]);
        $role = Role::create([
            'name' => $data['role']['name']
        ]);
        $role->syncPermissions($data['user_permissions']);
        $this->emit('refreshRolesList');
        $this->dispatchBrowserEvent('close-modal');
        $this->role = [];
    }

    public function render()
    {
        return view('livewire.users.roles.role-create');
    }
}
