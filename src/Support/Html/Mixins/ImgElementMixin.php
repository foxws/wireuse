<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Spatie\Html\Elements\Img;

class ImgElementMixin
{
    public function srcset(): mixed
    {
        return function (?string $value = null) {
            /** @var Img $this */
            return $this->attribute('srcset', $value);
        };
    }

    public function loading(): mixed
    {
        return function (?string $value = 'lazy') {
            /** @var Img $this */
            return $this->attribute('loading', $value);
        };
    }
}
