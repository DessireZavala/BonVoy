<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // El método que te faltaba
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // El que recibe los datos de Google
    public function handleGoogleCallback()
    {
        try {
            $userGoogle = Socialite::driver('google')->user();
            
            $user = User::updateOrCreate(
                ['email' => $userGoogle->getEmail()],
                [
                    'name' => $userGoogle->getName(),
                    'google_id' => $userGoogle->getId(),
                    'password' => bcrypt(Str::random(16)),
                ]
            );

            Auth::login($user);
            return redirect($this->redirectTo);

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Hubo un problema con Google.');
        }
    }
}