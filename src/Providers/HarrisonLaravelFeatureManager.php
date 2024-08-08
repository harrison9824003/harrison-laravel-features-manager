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
        // 移動 config 檔案到 config 資料夾
        $this->publishes([
            __DIR__.'/../config/harrisonFeatureManger.php' => config_path('harrisonFeatureManger.php'),
        ], 'harrison-feature-manager-config');
        $this->commands([
            \Harrison\LaravelFeatureManager\Console\Commands\InitFeaturesCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
