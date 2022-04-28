<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetToken extends Component
{
    public $password ,$password_confirmation, $token_data = [];

    public function mount($token)
    {

        $data = DB::table('password_resets')->where('token', $token)->first();

        if (!$data) {
            return $this->redirect(route('login'));
        }

        $this->token_data = (array) $data;

    }

    public function update()
    {

        $data = DB::table('password_resets')->where('token', $this->token_data['token'])->first();

        if($data) {
            $user = $this->validate([
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::where('email', $data->email)->update(['password' => Hash::make($user['password'])]);

            DB::table('password_resets')->where('token', $this->token_data['token'])->delete();

            return $this->redirect(route('login'));

        }else{
            $this->addError('password','خطأ في كود الاستعادة');
        }

    }

    public
    function render()
    {
        return view('livewire.reset-token')->layout('layouts.guest');
    }
}
