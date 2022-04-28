<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

class Forgot extends Component
{
    public  $email;

    public function send_reset(){

        $user = $this->validate([
            'email' => 'required|email|exists:' . User::class . ',email',
        ]);

        $user = User::where('email',$this->email)->first();
        $tokenData = DB::table('password_resets')->where('email', $user->email)->first();


        if($tokenData) {
            $this->addError("email", "تم الارسال مسبقا يرجى مراجعة الايميل الخاص بك");
//            DB::table('password_resets')->where('email', $user->email)->delete();
        }else{
            //create a new token to be sent to the user.
            $reset = DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => Str::random(60), //change 60 to any length you want
                'created_at' => Carbon::now()
            ]);

            $tokenData = DB::table('password_resets')->where('email', $user->email)->first();
            $user->email("استعادة كلمة المرور !", view("emails.restore-password", ["email" => $user->email, 'token' => $tokenData->token])->render());
            $this->addError("email", "تم الارسال بنجاح");
        }
    }

    public function render()
    {
        return view('livewire.forgot')->layout('layouts.guest');
    }
}
