<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersModel extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshUsersModelList' => 'ActionRefreshUsersModelList'
    ];

    function ActionRefreshUsersModelList()
    {

    }

    public function render()
    {
        return view('livewire.users.users-model', [
            'users' => User::paginate(5)
        ]);
    }
}
