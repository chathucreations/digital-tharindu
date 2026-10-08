<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Symfony\Component\HtmlSanitizer\HtmlSanitizer;
use Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use HasSlug;
    use LogsActivity;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'image',
        'is_digital',
        'is_active',
        'is_featured',
        'access_details',
        'file_path',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    protected function casts(): array
    {
        return [
            'is_digital' => 'boolean',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Price for a given billing cycle, or the lowest available price.
     */
    public function priceFor(?string $cycle = null): ?float
    {
        if ($cycle) {
            $price = $this->variations->firstWhere('billing_cycle', $cycle)?->price;

            if ($price !== null) {
                return (float) $price;
            }
        }

        $min = $this->variations->min('price');

        return $min !== null ? (float) $min : null;
    }

    public function hasCycle(string $cycle): bool
    {
        return $this->variations->contains('billing_cycle', $cycle);
    }

    /**
     * Sanitize the rich-text description on save to prevent stored XSS.
     */
    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value === null ? null : self::sanitizeHtml($value),
        );
    }

    public static function sanitizeHtml(string $html): string
    {
        $config = (new HtmlSanitizerConfig())
            ->allowSafeElements()
            ->allowLinkSchemes(['http', 'https', 'mailto'])
            ->allowRelativeLinks()
            ->allowRelativeMedias()
            ->allowElement('u')
            ->allowElement('span')
            ->allowElement('div')
            ->allowElement('table')
            ->allowElement('thead')
            ->allowElement('tbody')
            ->allowElement('tr')
            ->allowElement('th')
            ->allowElement('td')
            ->allowAttribute('class', '*')
            ->allowAttribute('style', '*');

        return (new HtmlSanitizer($config))->sanitize($html);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('product')
            ->setDescriptionForEvent(fn (string $eventName) => match ($eventName) {
                'created' => 'Product created',
                'updated' => 'Product updated',
                'deleted' => 'Product deleted',
                default => $eventName,
            });
    }
}
