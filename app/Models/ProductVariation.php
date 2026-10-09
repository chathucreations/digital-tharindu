<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductVariation extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariationFactory> */
    use HasFactory, LogsActivity;

    protected $fillable = [
        'product_id',
        'billing_cycle',
        'price',
        'original_price',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'original_price' => 'decimal:2',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getLabelAttribute(): string
    {
        return ucfirst($this->billing_cycle);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('product_variation')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Price variation created',
                'updated' => 'Price variation updated',
                'deleted' => 'Price variation deleted',
                default => $eventName,
            });
    }
}
