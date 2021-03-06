<?php

namespace App\Intervention\Templates;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
    	return $image->resize(120,null,function($constraint){
            $constraint->aspectRatio();
        });
    }
}
