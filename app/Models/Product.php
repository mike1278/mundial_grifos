<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @mixin \Eloquent
 */
class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'discount',
        'published',
        'serial_code',
        'options',
        'base_price',
        'category_id',
        'currency_id',
    ];

    public function setNameAttribute($value): string
    {
        return $this->attributes['name'] = ucwords($value);
    }

    public function image(): MorphMany
    {
        return $this->morphMany(File::class,'fileable');
    }
    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class);
    }
}
