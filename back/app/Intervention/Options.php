<?php

namespace App\Intervention;

trait Options
{
    public function ApplyOptions($image){
        // $this->formatImage($image);
    }

    public function formatImage($image){
        if(request()->has('mime')){
            return $image->encode(request()->mime);
        }
        return $image;
    }
}
