<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Evaluation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $comment
 * @property int $rating
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereUpdatedAt($value)
 */
class Evaluation extends Model
{
}
