<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Spatie\Html\Elements\A;

class LinkElementMixin
{
    public function route(): mixed
    {
        return function (string $route, ...$parameters) {
            /** @var A $this */

            return $this->href(route($route, ...$parameters));
        };
    }
}
