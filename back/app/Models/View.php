<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\View
 *
 * @method static \Illuminate\Database\Eloquent\Builder|View newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|View newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|View query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $viewable_type
 * @property int $viewable_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|View whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereViewableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereViewableType($value)
 */
class View extends Model
{
}
