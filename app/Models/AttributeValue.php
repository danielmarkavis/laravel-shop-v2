<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method static attributeOnly(string $string)
 */
class AttributeValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'attribute_id',
    ];

    public function attribute(): BelongsTo
    {
        return $this
            ->BelongsTo(Attribute::class);
    }

    public function variants(): BelongsToMany
    {
        return $this
            ->BelongsToMany(Variant::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param                                       $name
     *
     * @return void
     */
    public function scopeAttributeOnly(Builder $query, $name)
    {
        $query
            ->whereHas('attribute', function ($query) use ($name) {
                $query->where('attributes.name', $name);
            }); //->orderBy('sequence')
    }

//     public function sizeOnly(): BelongsToMany
//     {
//         return $this
//             ->belongsToMany(Attribute::class)->where('name', 'size');
//     }
}
