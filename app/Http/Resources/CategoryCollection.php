<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CategoryCollection extends ResourceCollection
{
    public static $wrap = 'items';

    public function toArray(Request $request): Collection
    {
        return $this->collection->transform(
            fn (Category $category): array => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'cover' => $category->cover,
            ]
        );
    }
}
