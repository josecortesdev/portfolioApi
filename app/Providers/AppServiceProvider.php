<?php

namespace App\Providers;

use App\Contracts\TraductionGenerator;
use App\Http\Services\RapidTranslate;
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
        $this->app->bind(TraductionGenerator::class, RapidTranslate::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
