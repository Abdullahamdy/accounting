<?php

namespace App\Http\Livewire\Users\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshRolesList' => 'ActionRefreshRolesList'
    ];

    function ActionRefreshRolesList()
    {

    }

    public function render()
    {
        return view('livewire.users.roles.roles', [
            'roles' => Role::paginate(20)
        ]);
    }
}
