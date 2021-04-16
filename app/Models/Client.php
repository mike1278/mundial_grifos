<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Client
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $fillable = [
        'lastname',
        'ci',
        'phone',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
