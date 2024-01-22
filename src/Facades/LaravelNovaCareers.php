<?php

namespace Creode\LaravelNovaCareers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Creode\LaravelNovaCareers\LaravelNovaCareers
 */
class LaravelNovaCareers extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Creode\LaravelNovaCareers\LaravelNovaCareers::class;
    }
}
