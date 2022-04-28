<?php

namespace App\Http\Livewire\Users\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    public $role;
    public $permissions, $user_permissions;

    public function mount($role_id)
    {
        $this->role = Role::find($role_id);
        $this->user_permissions = $this->role->permissions->pluck('name','id')->toArray();
        $this->role = $this->role->toArray();

        $this->permissions = Permission::all();

    }

    public function update()
    {
        $data = $this->validate([
            'role.name' => 'required|string',
            'user_permissions' => 'nullable|array',
        ]);

        $role_update = Role::find($this->role['id']);
        $role_update->update([
            'name' => $data['role']['name']
        ]);
        $role_update->syncPermissions($data['user_permissions']);
        $this->emit('refreshRolesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.users.roles.role-edit');
    }
}
