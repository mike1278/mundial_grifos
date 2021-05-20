<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Color;
use App\Models\File;
use App\Models\Product;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\ColorObserver;
use App\Observers\FileObserver;
use App\Observers\ProductObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    public function boot()
    {
        $this->observers();
    }

    public function observers()
    {
        File::observe(FileObserver::class);
        Color::observe(ColorObserver::class);
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
