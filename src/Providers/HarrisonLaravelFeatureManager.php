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
            __DIR__.'/../config/harrison_feature_manger.php' => config_path('harrison_feature_manger.php'),
        ], 'harrison-feature-manager-config');
        $this->commands([
            \Harrison\LaravelFeatureManager\Console\Commands\InitFeaturesCommand::class,
            \Harrison\LaravelFeatureManager\Console\Commands\RefreshFeaturesCommand::class,
        ]);
        $this->mergeConfigFrom(
            __DIR__.'/../config/database.php', 'database.connections.harrison_laravel_feature_manager'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
