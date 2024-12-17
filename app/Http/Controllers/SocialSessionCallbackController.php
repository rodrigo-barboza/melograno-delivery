<?php

namespace App\Http\Controllers;

use App\Http\Services\Socialite\SocialiteService;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SocialSessionCallbackController extends Controller
{
    public function __invoke(string $provider, SocialiteService $socialite): RedirectResponse
    {
        $social_user = $socialite->resolveProvider($provider)->user();
        
        if (! ($user = User::whereEmail($social_user->email)->first())) {
            $user = User::create([
                ...$social_user->toArray(),
                'password' => bcrypt(uniqid()),
            ]);
        }

        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
