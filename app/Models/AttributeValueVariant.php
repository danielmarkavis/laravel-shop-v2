<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValueVariant extends Model
{
    use HasFactory;

    protected $table = 'attribute_value_variant';

    protected $fillable = [
        'variant_id',
        'attribute_value_id',
    ];
}
