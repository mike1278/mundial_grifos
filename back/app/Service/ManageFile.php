<?php

namespace App\Service;

use Illuminate\Http\File;
class ManageFile
{
    public static function saveTemporal($file): string
    {
        return (
            new File(
            storage_path('app/public/') . $file
            )
        )->move(storage_path('app/public/'))->getFilename();
    }
}
