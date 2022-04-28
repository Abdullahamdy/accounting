<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditProfile extends Component
{

    protected $listeners = ['refreshUserProfile' => 'refreshUserProfileFunction'];

    public $user,$roles = [],$permissions = [],$selectedPermissions = [];

    public function refreshUserProfileFunction()
    {

    }

    public function updatedUserRoleId($role_id)
    {

    }

    public function mount()
    {

        $user = User::findOrFail(auth()->id());
        $this->user = $user->toArray();
     }

    public function update()
    {

        $user = $this->validate([
            'user.id' => 'required|numeric',
            'user.email' => 'required|email|unique:' . User::class . ',email,'.$this->user['id'],
            'user.password' => 'min:6|confirmed',
            'user.mobile' => '',
        ]);

        if(isset($user['user']['password'])) {
            $user['user']['password'] = Hash::make($user['user']['password']);
        }else{
            unset($user['user']['password']);
        }

        if(empty($user['user']['mobile'])) {
            $user['user']['mobile'] = 0;
        }

        $user_update = User::where('id',auth()->id())->first();
        if($user_update) {
            $user_update->update($user['user']);
        }
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('refreshProfile');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
