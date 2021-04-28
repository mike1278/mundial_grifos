<?php

namespace App\Observers;

use App\Models\File;
use Storage;

class FileObserver
{
    public function deleted(File $file)
    {
        Storage::disk('public')->delete($file->url);
    }
}
