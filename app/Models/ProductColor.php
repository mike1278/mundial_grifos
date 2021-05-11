<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductOption
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $default
 * @property int $color_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductColor whereProductId($value)
 */
class ProductColor extends Model
{
}
