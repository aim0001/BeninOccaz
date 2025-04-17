<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(rand(100000, 999999)), // Mot de passe fort aléatoire
                    'user_type' => 'buyer',
                    'email_verified_at' => now(),
                ]);
            } else {
                // Mise à jour si l'utilisateur existe mais se connecte via Google pour la première fois
                if (empty($user->google_id)) {
                    $user->update(['google_id' => $googleUser->id]);
                }
            }

            Auth::login($user, true); // "true" pour "remember me"

            return redirect()->intended(
                $user->user_type === 'admin' ? '/admin/dashboard' : '/dashboard'
            );
        } catch (\Exception $e) {
            Log::error('Google Auth Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Nous n\'avons pas pu vous connecter avec Google. Veuillez réessayer ou utiliser une autre méthode.');
        }
    }
}
