<?php

namespace Foxws\WireUse\Views\Concerns;

use Artesaos\SEOTools\Facades\SEOMeta;

trait WithSeo
{
    public function bootWithSeo(): void
    {
        if (method_exists(static::class, 'getTitle')) {
            SEOMeta::setTitle($this->getTitle());
        }

        if (method_exists(static::class, 'getDescription')) {
            SEOMeta::setDescription($this->getDescription());
        }

        if (method_exists(static::class, 'getRobots')) {
            SEOMeta::setRobots($this->getRobots());
        }
    }
}
