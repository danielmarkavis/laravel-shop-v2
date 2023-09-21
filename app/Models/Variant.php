<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Collection;

class Variant extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'price',
        'sku',
        'stock'
    ];

    protected $appends = [
        'image',
        'background'
    ];

    protected $casts = [
        'price' => 'float'
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('variant_image')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('variant_thumbnail');
    }

    public function getProductSkuAttribute(): Collection
    {
        return $this->product()->pluck('sku');
    }

    public function product(): HasOne
    {
        return $this
            ->HasOne(Product::class, 'id','product_id');
    }

    public function attributeValues(): BelongsToMany
    {
        return $this
            ->belongsToMany(AttributeValue::class);
    }

    public function getImageAttribute(): ?object
    {
        if (!$this->hasMedia()) {
            return null;
        }

        $media = $this->getFirstMedia();
        $isSVG = $media?->mime_type === 'image/svg+xml';

        return (object)[
            'id' => $media->id,
            'url' => $media->getUrl(),
            'thumbnail' => $isSVG ? $media->getUrl() : $media->getUrl('variant_thumbnail'),
            'mime_type' => $media->getTypeFromMime()
        ];
    }

    public function getBackgroundAttribute(): string
    {
        return sprintf('bg-%s-500', $this->colour); // this now needs to goto $variant->attributes->colour whatever that entails.
    }
}
