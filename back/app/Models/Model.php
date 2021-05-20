<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Model
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Model newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Model query()
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Model whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Model extends BaseModel
{
    protected $fillable = [
        'name',
    ];

    public function setNameAttribute($value){
        return $this->attributes['name'] = ucwords($value);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
