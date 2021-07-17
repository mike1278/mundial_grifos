<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Currency
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @property string $acronym
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereAcronym($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rate[] $rates
 * @property-read int|null $rates_count
 */
class Currency extends Model
{
    protected $fillable = [
        'name', 'symbol','acronym'
    ];

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class)
            ->where('active',true)
            ->orderByDesc('id');
    }
    public function oldRates(): HasMany
    {
        return $this->hasMany(Rate::class)
            ->where('active',false)
            ->orderByDesc('id');
    }
    public function rate(): HasOne
    {
        return $this->hasOne(Rate::class, 'to_currency_id')
            ->where('active',true)
            ->orderByDesc('id');
    }
}
