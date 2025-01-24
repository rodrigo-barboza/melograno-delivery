<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Socialite\SocialiteService;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSocialSessionController extends Controller
{
    public function __invoke(string $provider, SocialiteService $socialite): RedirectResponse
    {
        return $socialite->resolveProvider($provider)->redirect();
    }
}
