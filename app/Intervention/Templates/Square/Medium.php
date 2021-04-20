<?php

namespace App\Intervention\Templates\Square;

use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Filters\FilterInterface;

class Medium implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $width = $image->width()>$image->height()?240:null;
        $height= $width==null?240:null;
    	$canvas = ImageManagerStatic::canvas(240, 240, '#ffffff');
    	$image = $image->resize($width,$height,function($constraint){
            $constraint->aspectRatio();
        });
    	return $canvas->insert($image,'center');
    }
}
