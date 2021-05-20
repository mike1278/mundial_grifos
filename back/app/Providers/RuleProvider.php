<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RuleProvider extends ServiceProvider
{
    public function register(){}

    public function boot()
    {
        Validator::extend('exists_file', function($attribute, $value){
            return Storage::disk('public')->exists($value);
        });
    }
}
