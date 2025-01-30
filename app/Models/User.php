<?php

namespace App\Models;

use App\Enums\SocialDriverEnum;
use App\Models\Traits\TitleableName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TitleableName;

    protected $fillable = [
        'name',
        'email',
        'cover',
        'password',
        'provider',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'provider' => SocialDriverEnum::class,
        ];
    }

    protected function cover(): Attribute
    {
        return Attribute::make(
            get: fn(string $value): string => $value,
            set: fn(string $value): string => $value
                ?: 'https://avatar.oxro.io/avatar.svg?name='. ucwords($this->name),
        );
    }

    public function establishment(): HasOne
    {
        return $this->hasOne(Establishment::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
