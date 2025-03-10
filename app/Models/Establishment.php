<?php

namespace App\Models;

use App\Models\Scopes\EstablishmentResponsibleScope;
use App\Models\Traits\TitleableName;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

#[ScopedBy(EstablishmentResponsibleScope::class)]
class Establishment extends Model
{
    use HasFactory, TitleableName;

    protected $guarded = [];

    public $timestamps = false;

    public function minimumOrderValue(): Attribute
    {
        return Attribute::make(
            get: fn ($value): float|int => $value / 100,
            set: fn ($value): float|int => $value * 100,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function establishmentCategory(): HasOne
    {
        return $this->hasOne(EstablishmentCategory::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(EstablishmentCategory::class, 'establishment_establishment_category');
    }

    public function operatingHour(): HasMany
    {
        return $this->hasMany(OperatingHour::class);
    }

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeFilterByName(Builder $query, string $name): void
    {
        $query->where('name', 'like', '%'.Str::lower($name).'%');
    }
}
