<?php

namespace Creode\LaravelNovaCareers\Providers;

use Illuminate\Support\ServiceProvider;
use Creode\LaravelCareers\Repositories\CareerRepository;
use Creode\LaravelNovaCareers\PageBlocks\VacanciesPageBlock;

class CareersPageBlockProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        new VacanciesPageBlock($this->app->make(CareerRepository::class));
    }
}
