<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderState
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderState whereDeletedAt($value)
 */
class OrderState extends Model
{
}
