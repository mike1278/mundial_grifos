<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * App\Models\Product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $discount
 * @property int $published
 * @property string $serial_code
 * @property mixed $options
 * @property float $base_price
 * @property int $base_quantity
 * @property int $category_id
 * @property int $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $image
 * @property-read int|null $image_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBasePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBaseQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSerialCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @property int $model_id
 * @property int $brand_id
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereModelId($value)
 * @property float $price
 * @property int $quantity
 * @property-read \App\Models\Brand|null $brand
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Color[] $colors
 * @property-read int|null $colors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[] $images
 * @property-read int|null $images_count
 * @property-read \App\Models\Model|null $model
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 */
class Product extends BaseModel
{
    protected $fillable = [
        'name',
        'description',
        'discount',
        'published',
        'serial_code',
        'options',
        'price',
        'quantity',
        'brand_id',
        'model_id',
        'category_id',
        'currency_id',
    ];

    public function setNameAttribute($value): string
    {
        return $this->attributes['name'] = ucwords($value);
    }

    public function images(): MorphMany
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
    public function model(): HasOne
    {
        return $this->hasOne(Model::class);
    }
    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class);
    }
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class,ProductColor::class);
    }
}
