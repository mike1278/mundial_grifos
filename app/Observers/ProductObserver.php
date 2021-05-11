<?php

namespace App\Observers;

use App\Models\Product;
use Log;
use Storage;
use Throwable;

class ProductObserver
{
    public function created(Product $product)
    {
        //
    }

    public function updated(Product $product)
    {
        //
    }

    public function deleted(Product $product)
    {
        $product->load('images');
        foreach ($product->images as $image){
            try{
                Storage::delete($image->url);
                $image->delete();
            }catch (Throwable $e){
                Log::error($e);
            }
        }
    }
}
