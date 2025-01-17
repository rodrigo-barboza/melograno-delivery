<?php

namespace App\Models;

use App\Models\Traits\TitleableName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EstablishmentCategory extends Model
{
    use HasFactory, TitleableName;

    public $timestamps = false;

    public function establishments(): BelongsToMany
    {
        return $this->belongsToMany(Establishment::class, 'establishment_establishment_category');
    }
}
