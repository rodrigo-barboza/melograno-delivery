<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[ScopedBy([UserScope::class])]
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'neighborhood',
        'number',
        'cep',
        'city',
        'state',
        'complement',
    ];

    public function address(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Str::title("$this->neighborhood, $this->street, $this->number"),
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
