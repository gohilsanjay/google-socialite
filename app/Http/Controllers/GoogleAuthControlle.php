<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class GoogleAuthControlle extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();

    }
    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            //dd($google_user->id);
            $user = User::where('google_id',$google_user->id)->first();
            if(!$user)
            {
                $new_user = new User();
                $new_user->name = $google_user->name;
                $new_user->email = $google_user->email;
                $new_user->google_id = $google_user->id;
                $new_user->save();
               
                Auth::login($new_user);
                return redirect()->intended('home');
            }
            else
            {
                Auth::login($user);
                
                return redirect()->intended('home');
            }

        } catch (\Throwable $th) {
            dd('something went wrong', $th->getMessage());
        }
    }
}
