<?php

namespace Foxws\WireUse\Views\Concerns;

use Foxws\WireUse\Support\Blade\Bladeable;

trait WithLayout
{
    public function classFor(string $key, string $default = ''): string
    {
        return $this->attributes->get(
            app(Bladeable::class)::classKeys($key)->first(), $default
        );
    }
}
