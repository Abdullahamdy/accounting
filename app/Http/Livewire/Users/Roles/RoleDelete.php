<?php

namespace App\Http\Livewire\Users\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleDelete extends Component
{
    public $role;

    public function mount($role_id)
    {
        $this->role = Role::find($role_id);
    }

    public function delete()
    {
        $role = Role::find($this->role['id']);
        $role->delete();

        $this->emit('refreshRolesList');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.users.roles.role-delete');
    }
}
