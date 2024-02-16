<?php

namespace Creode\LaravelNovaCareers;

use Laravel\Nova\Nova;
use Spatie\LaravelPackageTools\Package;
use Creode\LaravelNovaCareers\Nova\CareerResource;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Creode\LaravelCareers\Http\Controllers\CareerController;
use Creode\LaravelNovaCareers\Http\Controllers\NovaCareerController;

class LaravelNovaCareersServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-nova-careers')
            ->hasConfigFile()
            ->hasViews('nova-careers');
    }

    public function boot()
    {
        parent::boot();

        // Load in configuration by default.
        $this->mergeConfigFrom(__DIR__.'/../config/nova-careers.php', 'nova-careers');

        // Replace default controller so we can override the view that gets rendered.
        $this->app->bind(CareerController::class, NovaCareerController::class);

        // Set TrafficCop on the CareerResource
        CareerResource::$trafficCop = config('nova-careers.traffic_cop');

        // Register the Model for the CareerResource and the CareerResource itself.
        CareerResource::$model = config('careers.model');
        Nova::resources([
            CareerResource::class,
        ]);
    }
}
