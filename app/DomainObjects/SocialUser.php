<?php

namespace App\DomainObjects;

use Illuminate\Contracts\Support\Arrayable;

class SocialUser implements Arrayable
{
    public function __construct(
        public readonly string $name,
        public readonly string $cover,
        public readonly string $email,
        public readonly string $provider,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'cover' => $this->cover,
            'email' => $this->email,
            'provider' => $this->provider,
        ];
    }
}
