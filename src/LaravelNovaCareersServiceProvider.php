<?php

namespace Creode\LaravelNovaCareers;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Creode\LaravelNovaCareers\Commands\LaravelNovaCareersCommand;

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
            ->hasViews()
            ->hasMigration('create_laravel-nova-careers_table')
            ->hasCommand(LaravelNovaCareersCommand::class);
    }
}
