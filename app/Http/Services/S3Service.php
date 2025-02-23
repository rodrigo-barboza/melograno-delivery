<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class S3Service
{
    private int $expiration_minutes = 30;

    public function getTemporaryUrl(string $path): string
    {
        $cache_key = "public_url_{$path}_{$this->expiration_minutes}";

        return cache()->remember(
            $cache_key,
            now()->addMinutes($this->expiration_minutes),
            fn() => Storage::disk('s3')
                ->temporaryUrl(
                    $path,
                    now()->addMinutes($this->expiration_minutes)
                ),
        );
    }

    public function setExpirationMinutes(int $minutes): self
    {
        $this->expiration_minutes = $minutes;

        return $this;
    }
}
