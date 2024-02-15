<?php

namespace Creode\LaravelNovaCareers\Models;

use Creode\LaravelCareers\Models\Career;
use Creode\NovaPageBuilder\Traits\HasComponents;
use Whitecube\NovaFlexibleContent\Concerns\HasFlexible;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class NovaCareer extends Career
{
    use HasComponents, HasFlexible;

    /**
     * Defines casts for model attributes.
     *
     * @var array
     */
    protected $casts = [
        'description' => FlexibleCast::class,
    ];

    /**
     * Define the field used for components.
     *
     * @var string
     */
    protected $componentField = 'description';
}
