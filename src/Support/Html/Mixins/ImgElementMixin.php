<?php

namespace Foxws\WireUse\Support\Html\Mixins;

class ImgElementMixin
{
    public function srcset(): mixed
    {
        return function (?string $value = null) {
            return $this->attribute('srcset', $value);
        };
    }

    public function loading(): mixed
    {
        return function (?string $value = 'lazy') {
            return $this->attribute('loading', $value);
        };
    }
}
