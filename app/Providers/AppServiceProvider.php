<?php

namespace App\Providers;

use App\Observers\BusObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Bus;
use Illuminate\Support\Facades\Validator;
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
     */
    public function boot(): void
    {
        //
        Validator::extend('greater_than_field', function ($attribute, $value, $parameters, $validator) {
            $otherField = $parameters[0];
            $otherValue = $validator->getData()[$otherField];

            return $value > $otherValue;
        });    }
}
