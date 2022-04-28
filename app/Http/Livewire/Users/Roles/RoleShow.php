<?php

namespace App\Http\Livewire\Users\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleShow extends Component
{
    public $role;
    protected $listeners = [
        'refreshRoleShow' => 'ActionRefreshRoleShow'
    ];

    public function ActionRefreshRoleShow()
    {

    }

    public function mount($role_id)
    {
        $this->role = Role::where('id', $role_id)->first();
    }

    public function render()
    {
        return view('livewire.users.roles.role-show');
    }
}
