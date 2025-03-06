<?php

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class S3Service
{
    private int $expiration_minutes = 30;

    public function getTemporaryUrl(string $path): string
    {
        $cache_key = "public_url_{$path}_{$this->expiration_minutes}";

        return cache()->remember(
            $cache_key,
            now()->addMinutes($this->expiration_minutes),
            fn() => Storage::disk('s3')->temporaryUrl(
                $path,
                now()->addMinutes($this->expiration_minutes)
            ),
        );
    }

    public function saveFile(UploadedFile $file, string $path = 'dishes'): string
    {
        $path = Storage::disk('s3')->putFile($path, $file);

        if (! Storage::disk('s3')->exists($path)) {
            throw new RuntimeException('Falha ao salvar o arquivo');
        }

        return $path;
    }

    public function updateFile(UploadedFile $file, string $old_path): string
    {
        if (Storage::disk('s3')->exists($old_path)) {
            Storage::disk('s3')->delete($old_path);
        }

        $path = Storage::disk('s3')->putFile('dishes', $file);

        if (! Storage::disk('s3')->exists($path)) {
            throw new RuntimeException('Falha ao salvar o arquivo');
        }

        return $path;
    }

    public function setExpirationMinutes(int $minutes): self
    {
        $this->expiration_minutes = $minutes;

        return $this;
    }
}
