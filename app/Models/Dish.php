<?php

namespace App\Models;

use App\Models\Traits\TitleableName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    use HasFactory;
    use TitleableName;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category_id',
    ];

    public function price(): Attribute
    {
        return Attribute::make(
            get: fn (int $value): int => $value / 100,
            set: fn (int|float $value): int => $value * 100,
        );
    }

    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
