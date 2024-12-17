<?php

namespace App\Http\Services\Socialite;

class SocialiteService
{
    public function resolveProvider(string $provider): SocialiteDriver
    {
        if (! $this->providerExists($provider)) {
            throw new \InvalidArgumentException('Provider does not exist in this application.');
        }

        $class_name = 'App\\Http\\Services\\Socialite\\' . str($provider)->studly() . 'Driver';

        if (! class_exists($class_name)) {
            throw new \InvalidArgumentException("Driver class {$class_name} not found.");
        }

        return new $class_name;
    }

    public function providerExists(string $provider): bool
    {
        return array_key_exists($provider, $this->getServices());
    }

    public function getServices(): array
    {
        return config('services');
    }
}
