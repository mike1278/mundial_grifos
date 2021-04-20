<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * App\Models\Category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $fillable = [
        'name','category_id'
    ];

    public function setNameAttribute($value): string
    {
        return $this->attributes['name'] = ucwords($value);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(File::class,'fileable');
    }
    public function fromCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
