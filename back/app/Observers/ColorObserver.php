<?php

namespace App\Observers;

use App\Models\Color;

class ColorObserver
{
    public function deleted(Color $color)
    {
        ($color->image()->first())->delete();
    }
}
