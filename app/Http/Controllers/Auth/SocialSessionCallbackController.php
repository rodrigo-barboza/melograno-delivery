<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
                'role' => 'consumer',
            ]);
        }

        Auth::login($user);

        return redirect()->intended(route('index', absolute: false));
    }
}
