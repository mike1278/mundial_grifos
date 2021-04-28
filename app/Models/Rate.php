<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Rate
 *
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $toCurrency
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rate query()
 * @mixin \Eloquent
 */
class Rate extends Model
{
    protected $fillable = [
        'rate','currency_id','to_currency_id'
    ];

    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function toCurrency(){
        return $this->belongsTo(Currency::class,'to_currency_id');
    }
}
