<?php

namespace Foxws\WireUse\Actions\Concerns;

use Closure;

trait HasState
{
    public function active(bool $active = true): static
    {
        $this->active = $active;

        return $this;
    }

    public function getActive(?Closure $value = null): bool
    {
        if (! $value instanceof Closure) {
            return $this->value('active', false);
        }

        return value($value, $this);
    }
}
