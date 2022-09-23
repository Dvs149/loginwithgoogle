<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialiteAuthController extends Controller
{
    public function index(Type $var = null)
    {
        return view('auth.socialite-auth');
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();

    }

    public function googleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->createOrUpdate($user,'google');
        return redirect()->route('dashboard');
    }
    public function createOrUpdate($data,$provider)
    {
        $user = User::where('email',$data->email)->first();
        if($user){
            $user->update([
                'provider' => $provider,
                'provider_id' => $data->id,
                'avatar' => $data->avatar
            ]);
        }else {
            $user = User::create([
                'name'=>$data->name,
                'email'=>$data->email,
                'provider' => $provider,
                'provider_id' => $data->id,
                'avatar' => $data->avatar,

            ]);
        }
        Auth::login($user);
    }
}
