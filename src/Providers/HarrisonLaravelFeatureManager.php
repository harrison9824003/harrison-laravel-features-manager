<?php
namespace Harrison\LaravelFeatureManager\Providers;

use Illuminate\Support\ServiceProvider;

class HarrisonLaravelFeatureManager extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
