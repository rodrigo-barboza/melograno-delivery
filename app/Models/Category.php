<?php

namespace App\Models;

use App\Enums\CategoryEnum;
use App\Models\Traits\TitleableName;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TitleableName;

    protected $appends = ['variant'];

    public function getVariantAttribute(): string
    {
        if (! $this->slug) {
            return 'green';
        }

        return CategoryEnum::from($this->slug)->variant();
    }
}
