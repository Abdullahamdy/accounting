<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads;

    protected $listeners = ['refreshAvatar' => '$refresh'];

    public $photo,$imageTemp;


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|mimes:jpeg,png',
        ]);

        $path = $this->photo->store('avatar', 'public');

        $user = User::where('id',auth()->id())->first();
        $user->avatar = $path;
        $user->save();

        $this->emit('refreshAvatar');

    }

    public function render()
    {
        return view('livewire.avatar');
    }
}
