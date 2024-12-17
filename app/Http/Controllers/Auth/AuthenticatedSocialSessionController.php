<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Socialite\SocialiteService;
use Illuminate\Http\Request;

class AuthenticatedSocialSessionController extends Controller
{
    public function __invoke(string $provider, SocialiteService $socialite)
    {
        return $socialite->resolveProvider($provider)->redirect();
    }
}
