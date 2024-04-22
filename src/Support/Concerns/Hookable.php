<?php

namespace Foxws\WireUse\Support\Concerns;

trait Hookable
{
    protected function callHook(string $hook, ...$args): mixed
    {
        if (method_exists($this, $hook)) {
            return $this->{$hook}(...$args);
        }

        return value($hook, $args);
    }
}
