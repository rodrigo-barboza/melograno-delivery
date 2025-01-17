<?php

namespace App\Models;

use App\Models\Traits\TitleableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Establishment extends Model
{
    use TitleableName, HasFactory;

    public $timestamps = false;

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
}
