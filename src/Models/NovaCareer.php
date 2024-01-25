<?php

namespace Creode\LaravelNovaCareers\Models;

use Creode\LaravelCareers\Models\Career;
use Creode\NovaPageBuilder\Services\BlockRenderer;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Whitecube\NovaFlexibleContent\Value\FlexibleCast;

class NovaCareer extends Career
{
    protected $casts = [
        'description' => FlexibleCast::class,
    ];

    /**
     * Exposes a set of components from the Page Builder.
     *
     * @return Attribute
     */
    protected function components(): Attribute
    {
        $blockRendererService = app()->make(BlockRenderer::class);
        return Attribute::make(
            get: function () use ($blockRendererService) {
                return $blockRendererService->render($this->description);
            }
        );
    }
}
