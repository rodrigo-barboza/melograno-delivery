<?php

namespace App\Http\Services\Socialite;

use App\DomainObjects\SocialUser;
use App\Enums\SocialDriverEnum;
use Illuminate\Http\RedirectResponse;

interface SocialiteDriver
{
    public function getDriver(): string;
    public function redirect(): RedirectResponse;
    public function user(): SocialUser;
}
