<?php

declare(strict_types=1);

namespace Finq\Ihamkor;

use Illuminate\Support\ServiceProvider;

class IhamkorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/ihamkor.php',
            'ihamkor'
        );

        $this->app->singleton(IhamkorService::class, fn() => new IhamkorService);

        $this->app->alias(IhamkorService::class, 'ihamkor');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ihamkor.php' => config_path('ihamkor.php'),
            ], 'ihamkor-config');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            IhamkorService::class,
            'ihamkor',
        ];
    }
}
