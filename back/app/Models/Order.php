<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $client_id
 * @property int|null $address_id
 * @property int $state_id
 * @property string $note
 * @property string $delivery_type
 * @property string $note_shop
 * @property int $viewed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNoteShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereViewed($value)
 * @mixin \Eloquent
 * @property mixed $payment_details
 * @property int $complete
 * @property-read \App\Models\Client $client
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order incomplete()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentDetails($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $orderProducts
 * @property-read int|null $order_products_count
 * @property int|null $rate_id
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereRateId($value)
 */
class Order extends Model
{
    protected $fillable = [
        'viewed',
        'address_id',
        'note',
        'note_shop',
        'rate_id',
        'delivery_type',
        'payment_details',
        'client_id',
        'state_id',
    ];

    public function scopeIncomplete($query){
        return $query->where('complete', false);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,OrderProduct::class)
            ->using(OrderProduct::class)
            ->withPivot([
                'quantity',
                'discount',
                'product_color_id',
                'price',
            ]);
    }
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }
}
