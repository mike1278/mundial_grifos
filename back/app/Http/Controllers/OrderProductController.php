<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Throwable;

class OrderProductController extends Controller
{
    public function store(Request $request, Product $product): JsonResponse
    {
        try {
            $order = Order::incomplete()->whereHas('client',function ($query)use($request){
                return $query->where('user_id',$request->user()->id);
            })->first();
            if(!$order){
                $client = $request->user()->client()->first();
                $order = Order::create([
                    'client_id' => $client->id,
                    'address_id' => $client->addresses()->first()->id,
                    'state_id' => 1,
                    'rate_id' => Rate::whereHas('toCurrency', function ($query){
                        $query->where('symbol','BS');
                    })->where('active', true)->firstOrFail()->id,
                    'note' => '',
                    'delivery_type' => 'pick up',
                    'note_shop' => '',
                    'viewed' => false,
                    'payment_details' => '{}',
                    'complete' => false,
                ]);
            }
            if($product->quantity < $request->quantity){
                return response()->json(['message' => 'La cantidad supera el stock disponible'],403);
            }
            $orderProduct = $order->orderProducts()
                ->where('product_color_id', $request->product_color_id)
                ->where('product_id',$product->id)
                ->first();
            if($orderProduct){
                return response()->json(['message' => 'Ya posee este articulo'],403);
            }
            $order->products()->attach($product, array_merge(
                $request->only([
                    'quantity',
                    'product_color_id',
                ]),
                [
                    'price' => $product->price,
                    'discount' => $product->discount,
                ]
            ));
        }catch (Throwable $e){
            Log::error($e);
            abort(500, 'Error agregado el producto al carrito');
        }
        return response()->json(['message' => 'El producto fue agregado']);
    }

    public function confirm(Request $request): JsonResponse
    {
        try {
            $order = Order::incomplete()->whereHas('client',function ($query)use($request){
                return $query->where('user_id', $request->user()->id);
            })->firstOrFail();
            $order->rate_id = Rate::whereHas('toCurrency', function ($query){
                $query->where('symbol','BS');
            })->where('active', true)->firstOrFail()->id;

            $order->complete = true;
            $order->note = $request->note;
            $order->delivery_type = $request->delivery_type;
            $order->address_id = $request->address_id;
            $order->payment_details = $request->payment_details;
            $order->save();
        }catch (Throwable $e){
            Log::error($e);
            abort(500, 'Error procesando la orden');
        }
        return response()->json(['message' => 'La orden a sido procesada']);
    }

    public function update(Request $request, $product): JsonResponse
    {
        try {
            $order = Order::incomplete()->whereHas('client',function ($query)use($request){
                return $query->where('user_id',$request->user()->id);
            })->firstOrFail();
            $orderProduct = $order->orderProducts()
                ->where('product_id', $product)
                ->where('product_color_id', $request->color_id)
                ->firstOrFail();
            $product = Product::where('id', $product)->firstOrFail();
            if($product->quantity < $request->quantity){
                return response()->json(['message' => 'La cantidad supera el stock disponible'],403);
            }
            if(1 > $request->quantity){
                $orderProduct->delete();
                return response()->json(['message' => 'Se elimino el producto del carrito'],201);
            }
            $orderProduct->update($request->only([
                'quantity',
            ]));
        }catch (Throwable $e){
            Log::error($e);
            abort(500, 'Error actualizando el producto del carrito');
        }
        return response()->json(['message' => 'El producto fue actualizado']);
    }

    public function destroy(Request $request,$product): JsonResponse
    {
        try {
            $order = Order::incomplete()->whereHas('client',function ($query)use($request){
                return $query->where('user_id', $request->user()->id);
            })->firstOrFail();
            OrderProduct::where('order_id', $order->id)
                ->where('product_id',$product)
                ->delete();
        }catch (Throwable $e){
            Log::error($e);
            abort(500, 'Error eliminando el producto del carrito');
        }
        return response()->json(['message' => 'El producto fue eliminado']);
    }
}
