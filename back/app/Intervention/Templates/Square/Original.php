<?php

namespace App\Intervention\Templates\Square;

use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Filters\FilterInterface;

class Original implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        $size = $image->width()>$image->height()?$image->width():$image->height();
    	$canvas = ImageManagerStatic::canvas($size, $size, '#ffffff');
    	return $canvas->insert($image,'center');
    }
}
