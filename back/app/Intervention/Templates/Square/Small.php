<?php

namespace App\Intervention\Templates\Square;

use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Filters\FilterInterface;

class Small implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = $image->width()>$image->height()?120:null;
        $height= $width==null?120:null;
    	$canvas = ImageManagerStatic::canvas(120, 120, '#ffffff');
    	$image = $image->resize($width,$height,function($constraint){
            $constraint->aspectRatio();
        });
    	return $canvas->insert($image,'center');
    }
}
