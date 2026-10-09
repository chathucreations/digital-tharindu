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
        'images',
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
            'images' => 'array',
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
     * The storefront image gallery: the main image first, followed by the
     * optional gallery images (capped at three for the gallery UI).
     *
     * @return array<int, string> absolute URLs ready for <img src>
     */
    public function galleryImages(): array
    {
        $paths = [];

        if (filled($this->image)) {
            $paths[] = $this->image;
        }

        if (is_array($this->images)) {
            foreach ($this->images as $path) {
                if (filled($path) && ! in_array($path, $paths, true)) {
                    $paths[] = $path;
                }
            }
        }

        return array_map(static fn (string $path) => media_url($path), array_slice($paths, 0, 3));
    }

    /**
     * The lowest variation price, optionally with its original (struck) price.
     *
     * @return array{price: ?float, original_price: ?float, discount_percent: ?int}
     */
    public function priceInfo(): array
    {
        $variation = $this->variations->sortBy(fn (ProductVariation $v) => (float) $v->price)->first();

        $price = $variation?->price !== null ? (float) $variation->price : null;
        $original = $variation?->original_price !== null ? (float) $variation->original_price : null;

        $discount = ($price !== null && $original !== null && $original > $price)
            ? (int) round((1 - ($price / $original)) * 100)
            : null;

        return [
            'price' => $price,
            'original_price' => $original,
            'discount_percent' => $discount,
        ];
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
