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
 * @property int $id
 * @property string $name
 * @property int|null $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Category $fromCategory
 * @property-read \App\Models\File|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
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
