<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function deleted(Category $category)
    {
        $file = $category->image()->first();
        $file->delete();
    }
}
