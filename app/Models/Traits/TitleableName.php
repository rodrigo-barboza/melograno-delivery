<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait TitleableName
{
    public function name(): Attribute
    {
        return new Attribute(
            get: fn(string $title): string => Str::title($title)
        );
    }
}
