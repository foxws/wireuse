<?php

namespace Foxws\WireUse\Views\Concerns;

use Artesaos\SEOTools\Traits\SEOTools;

trait WithSeo
{
    use SEOTools;

    public function bootWithSeo(): void
    {
        if (method_exists(static::class, 'getTitle')) {
            $this->seo()->setTitle(static::getTitle());
        }

        if (method_exists(static::class, 'getDescription')) {
            $this->seo()->setDescription(static::getDescription());
        }
    }
}
