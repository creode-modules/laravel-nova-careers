<?php

namespace Creode\LaravelNovaCareers;

use Laravel\Nova\Nova;
use Spatie\LaravelPackageTools\Package;
use Creode\LaravelNovaCareers\Nova\CareerResource;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile();
    }

    public function boot()
    {
        parent::boot();

        // Load in configuration by default.
        $this->mergeConfigFrom(__DIR__.'/../config/nova-careers.php', 'nova-careers');

        // Register the Model for the CareerResource and the CareerResource itself.
        CareerResource::$model = config('careers.model');
        Nova::resources([
            CareerResource::class,
        ]);
    }
}
