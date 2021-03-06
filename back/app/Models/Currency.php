<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Rate[] $oldRates
 * @property-read int|null $old_rates_count
 * @property-read \App\Models\Rate|null $rate
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereDeletedAt($value)
 */
class Currency extends Model
{
    use SoftDeletes;

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
