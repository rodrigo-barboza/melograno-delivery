<?php

namespace App\Models;

use App\Enums\PaymentStatusEnum;
use App\Models\Scopes\UserScope;
use App\Models\Traits\CalculateTotalPrice;
use App\Models\Traits\GeneratesOrderNumber;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ScopedBy([UserScope::class])]
class Order extends Model
{
    use CalculateTotalPrice;
    use GeneratesOrderNumber;

    protected $fillable = [
        'user_id',
        'establishment_id',
        'payment_type',
        'delivery_type',
        'status',
        'instructions',
        'number',
        'address',
        'cancelation_reason',
        'total',
        'delivery_tax',
        'total_items',
        'rate',
        'items',
        'session_id',
        'payment_status',
    ];

    protected $casts = ['items' => 'array'];

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn (int $value): int => $value / 100,
            set: fn (int $value): int => $value * 100,
        );
    }

    public function deliveryTax(): Attribute
    {
        return Attribute::make(
            get: fn (?int $value): ?int => $value ? $value / 100 : null,
            set: fn (?int $value): ?int => $value ? $value * 100 : null,
        );
    }

    public function totalItems(): Attribute
    {
        return Attribute::make(
            get: fn (int $value): int => $value / 100,
            set: fn (int $value): int => $value * 100,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function establishment(): BelongsTo
    {
        return $this->belongsTo(Establishment::class);
    }

    public function scopeUnpaid(Builder $query): void
    {
        $query->where('payment_status', PaymentStatusEnum::UNPAID->value);
    }

    public function markAsPaid(): void
    {
        $this->payment_status = PaymentStatusEnum::PAID->value;
        $this->save();
    }
}
