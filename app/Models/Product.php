<?php

namespace App\Models;

use App\Models\Traits\SearchableTrait;
use App\Models\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SearchableTrait;
    use SortableTrait;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sku',
        'sale_price'
    ];

    protected $appends = [
        'image',
        'currency'
    ];

    protected $casts = [
        'price' => 'float'
    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product_image')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('product_thumbnail')
            ->width(250);
    }

    public function variants(): HasMany
    {
        return $this
            ->HasMany(Variant::class);
    }

    /**
     * Will return either
     * 1) image from media
     * 2) Image from first variant.
     *
     * @return object|null
     */
    public function getImageAttribute(): ?object
    {
        if (!$this->hasMedia()) {
            $media = $this->variants?->first()->image ?? null;
            if (!$media) {
                return null;
            }
        } else {
            $media = $this->getFirstMedia();
        }
        $isSVG = $media?->mime_type === 'image/svg+xml';
        $url = $media->url ?? $media->getUrl() ?? null;
        $thumbnail = $media->thumbnail ?? $media->getUrl('product_thumbnail') ?? null;
        $mimeType = $media?->url ? null : $media->getTypeFromMime();

        return (object)[
            'id' => $media->id,
            'url' => $url,
            'thumbnail' => $isSVG ? $url : $thumbnail,
            'mime_type' => $mimeType
        ];
    }

    public function getCurrencyAttribute(): string
    {
        return number_format($this->price, 2);
    }

    public function getSearchableColumns(): array
    {
        return [
            'name',
        ];
    }

    public function getSortableColumns(): array
    {
        return [
            'name',
        ];
    }
}
