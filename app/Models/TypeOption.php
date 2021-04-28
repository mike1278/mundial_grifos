<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\TypeOption
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOption whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeOption whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TypeOption extends Model
{
    protected $fillable = [
        'name',
    ];

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
    public function productOption(): BelongsToMany
    {
        return $this->belongsToMany(ProductOption::class);
    }
}
