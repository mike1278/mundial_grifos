<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Rate
 *
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $toCurrency
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $rate
 * @property int $currency_id
 * @property int $to_currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereToCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rate whereUpdatedAt($value)
 */
class Rate extends Model
{
    protected $fillable = [
        'rate','currency_id','to_currency_id','active'
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
    public function toCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class,'to_currency_id');
    }
}
