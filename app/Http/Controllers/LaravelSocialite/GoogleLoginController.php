<?php

namespace App\Http\Controllers\LaravelSocialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();

        // return Socialite::driver('google')->redirect();
        
    }

    public function callbackGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id',$googleUser->getId())->first();

            if(!$user){
        
                $newUser=User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),

                ]);
                Auth::login($newUser);         
                return redirect()->intended('dashboard');
    

            }else{
                Auth::login($user);            
                return redirect('/dashboard');

            }
        } catch (\Throwable $th) {
            // throw $th;
        }

    }
 


}
