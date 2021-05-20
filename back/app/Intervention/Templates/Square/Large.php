<?php

namespace App\Intervention\Templates\Square;

use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Filters\FilterInterface;

class Large implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = $image->width()>$image->height()?480:null;
        $height= $width==null?480:null;
    	$canvas = ImageManagerStatic::canvas(480, 480, '#ffffff');
    	$image = $image->resize($width,$height,function($constraint){
            $constraint->aspectRatio();
        });
    	return $canvas->insert($image,'center');
    }
}
