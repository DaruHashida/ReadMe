<?php

namespace App\Providers;

use App\Rules\DownloadableImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Validator::extend(
            'downloadable_image', function ($attribute, $value, $parameters, $validator) {
                return (new DownloadableImage())->passes($attribute, $value);
            }
        );
    }
}
