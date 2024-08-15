<?php

namespace Foxws\WireUse\Views\Concerns;

use Artesaos\SEOTools\Facades\SEOMeta;
use Closure;

trait WithSeo
{
    public function bootWithSeo(): void
    {
        SEOMeta::setTitle((string) $this->seoValue('getTitle'));
        SEOMeta::setDescription((string) $this->seoValue('getDescription'));
        SEOMeta::setRobots((string) $this->seoValue('getRobots'));
    }

    protected function seoValue(mixed $value, mixed $default = null): mixed
    {
        if ($value instanceof Closure) {
            return value($value) ?? $default;
        }

        if (method_exists(static::class, $value)) {
            $value = $this->$value();

            return is_string($value) ? strip_tags($value) : $value;
        }

        return $default;
    }
}
