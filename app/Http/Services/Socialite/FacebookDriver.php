<?php

namespace App\Http\Services\Socialite;

use App\DomainObjects\SocialUser;
use App\Enums\SocialDriverEnum;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class FacebookDriver implements SocialiteDriver
{
    public SocialiteService $socialite {
        get => new SocialiteService();
    }

    public function getDriver(): string
    {
        return SocialDriverEnum::FACEBOOK->value;
    }

    public function redirect(): RedirectResponse
    {
        return Socialite::driver($this->getDriver())->redirect();
    }

    public function user(): SocialUser
    {
        $user = Socialite::driver($this->getDriver())
            ->stateless()
            ->user();

        return new SocialUser(
            name: $user->getName(),
            email: $user->getEmail(),
            cover: $user->getAvatar(),
            provider: $this->getDriver(),
        );
    }
}
