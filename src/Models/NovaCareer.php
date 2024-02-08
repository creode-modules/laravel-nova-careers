<?php

namespace Creode\LaravelNovaCareers\Models;

use Creode\LaravelCareers\Models\Career;
use Creode\NovaPageBuilder\Traits\HasComponents;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class NovaCareer extends Career
{
    use HasComponents;

    protected $casts = [
        'description' => FlexibleCast::class,
    ];

    protected $componentField = 'description';
}
