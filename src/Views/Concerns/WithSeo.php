<?php

namespace Foxws\WireUse\Views\Concerns;

use Artesaos\SEOTools\Facades\SEOMeta;

trait WithSeo
{
    public function bootWithSeo(): void
    {
        SEOMeta::setTitle($this->seoValue('getTitle'));
        SEOMeta::setDescription($this->seoValue('getDescription'));
        SEOMeta::setRobots($this->seoValue('getRobots'));
    }

    protected function seoValue(mixed $value, mixed $default = null): mixed
    {
        if ($value instanceof Closure) {
            return value($value) ?? $default;
        }

        if (method_exists(static::class, $value)) {
            return strip_tags($this->$value());
        }

        return $default;
    }
}
